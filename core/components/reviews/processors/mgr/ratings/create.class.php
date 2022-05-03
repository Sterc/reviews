<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsRatingCreateProcessor extends modObjectCreateProcessor
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

        $this->setMenuIndex();

        return parent::beforeSave();
    }

    /**
     * @access private.
     */
    private function setMenuIndex()
    {
        $criteria = $this->modx->newQuery($this->classKey);

        $criteria->sortby('menuindex', 'DESC');
        $criteria->limit(1);

        $object = $this->modx->getObject($this->classKey, $criteria);

        if ($object) {
            $this->object->set('menuindex', (int) $object->get('menuindex') + 1);
        } else {
            $this->object->set('menuindex', 0);
        }
    }
}

return 'ReviewsRatingCreateProcessor';
