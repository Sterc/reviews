<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsRatingRemoveProcessor extends modObjectRemoveProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'ReviewsRating';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['reviews:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'reviews.rating';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('reviews', 'Reviews', $this->modx->getOption('reviews.core_path', null, $this->modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/');

        return parent::initialize();
    }
}

return 'ReviewsRatingRemoveProcessor';
