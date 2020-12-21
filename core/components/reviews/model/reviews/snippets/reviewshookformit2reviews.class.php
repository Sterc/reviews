<?php

/**
 * Formit2Reviews
 *
 * Copyright 2020 by Thomas Jakobi <office@treehillstudio.com>
 */

require_once dirname(__DIR__) . '/reviewssnippets.class.php';

class ReviewsHookFormit2Reviews extends ReviewsSnippets
{
    /**
     * @access public.
     * @var Array.
     */
    public $properties = [
        'reviewsAutoPublish' => 0,
        'reviewsAllowOverwrite' => 0,
    ];

    /**
     * @access public.
     * @param Array $properties .
     * @param fiHooks $hook .
     * @return String.
     */
    public function run(array $properties, fiHooks $hook)
    {
        $fields = $hook->getValues();
        $this->setProperties($properties);

        $name = $this->getOption('name', $fields, '');
        $email = $this->getOption('email', $fields, '');
        $new = false;
        if ($name && $email) {
            /** @var ReviewsReview $review */
            if (!$review = $this->modx->getObject('ReviewsReview', [
                'resource_id' => $this->modx->resource->id,
                'name' => $name,
                'email' => $email,
            ])) {
                $review = $this->modx->newObject('ReviewsReview');
                $review->fromArray([
                    'resource_id' => $this->modx->resource->id,
                    'name' => $name,
                    'email' => $email,
                    'city' => $this->getOption('city', $fields, ''),
                    'content' => $this->getOption('content', $fields, ''),
                    'active' => (bool)$this->getProperty('reviewsAutoPublish'),
                    'createdon' => time(),
                ]);
                $review->save();
                $new = true;
            } elseif ((bool)$this->getProperty('reviewsAllowOverwrite')) {
                $review->fromArray([
                    'city' => $this->getOption('city', $fields, ''),
                    'content' => $this->getOption('content', $fields, ''),
                    'active' => (bool)$this->getProperty('reviewsAutoPublish'),
                    'editedon' => time(),
                ]);
                $review->save();
            } else {
                $hook->addError('name', $this->modx->lexicon('reviews.hook_error_overwrite'));
                $hook->addError('email', $this->modx->lexicon('reviews.hook_error_overwrite'));
            }

            $ratingRange = $this->getRatingRange();
            /** @var ReviewsRating[] $ratings */
            $ratings = $this->modx->getCollection('ReviewsRating', [
                'active' => true
            ]);
            foreach ($ratings as $rating) {
                if (isset($fields['rating_' . $rating->get('name')])) {
                    if (isset($ratingRange[$fields['rating_' . $rating->get('name')]])) {
                        if (!$reviewRating = $this->modx->getObject('ReviewsReviewRating', [
                            'review_id' => $review->get('id'),
                            'rating_id' => $rating->get('id')
                        ])) {
                            $reviewRating = $this->modx->newObject('ReviewsReviewRating');
                            $reviewRating->fromArray([
                                'review_id' => $review->get('id'),
                                'rating_id' => $rating->get('id'),
                            ]);
                        }
                        $reviewRating->fromArray([
                            'value' => $fields['rating_' . $rating->get('name')]
                        ]);
                        if (!$hook->hasErrors()) {
                            $reviewRating->save();
                        }
                    } else {
                        $hook->addError('rating_' . $rating->get('name'), $this->modx->lexicon('reviews.hook_error_rating_range'));
                    }
                }
            }
        }

        if ($hook->hasErrors() && !(bool)$this->getProperty('reviewsAllowOverwrite') && $new) {
            $review->remove();
        };
        return !$hook->hasErrors();
    }
}
