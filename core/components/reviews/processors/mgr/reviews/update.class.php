<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsReviewUpdateProcessor extends modObjectUpdateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'ReviewsReview';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['reviews:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'reviews.review';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('reviews', 'Reviews', $this->modx->getOption('reviews.core_path', null, $this->modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/');

        if ($this->getProperty('active') === null) {
            $this->setProperty('active', 0);
        }

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $this->object->set('editedon', date('Y-m-d H:i:s'));

        foreach ((array)$this->getProperty('rating', []) as $key => $value) {
            $rating = $this->modx->getObject('ReviewsReviewRating', [
                'review_id' => (int)$this->object->get('id'),
                'rating_id' => (int)$key
            ]);
            if (!$rating) {
                $rating = $this->modx->newObject('ReviewsReviewRating');
                $this->object->addMany($rating);
            }
            $rating->fromArray([
                'rating_id' => (int)$key,
                'value' => (int)$value
            ]);
            $rating->save();
        }

        return parent::beforeSave();
    }
}

return 'ReviewsReviewUpdateProcessor';
