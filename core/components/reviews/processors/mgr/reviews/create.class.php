<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsReviewCreateProcessor extends modObjectCreateProcessor
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
        $this->object->set('createdon', date('Y-m-d H:i:s'));

        foreach ((array) $this->getProperty('rating', []) as $key => $value) {
            $rating = $this->modx->newObject('ReviewsReviewRating');

            if ($rating) {
                $rating->fromArray([
                    'rating_id' => (int) $key,
                    'value'     => (int) $value
                ]);

                $this->object->addMany($rating);
            }
        }

        return parent::beforeSave();
    }
}

return 'ReviewsReviewCreateProcessor';
