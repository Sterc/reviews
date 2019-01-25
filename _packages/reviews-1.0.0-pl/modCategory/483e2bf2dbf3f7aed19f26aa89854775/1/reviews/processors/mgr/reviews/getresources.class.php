<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsReviewsResourcesGetListProcessor extends modObjectGetListProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'modResource';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['reviews:default'];

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortField = 'Resource.pagetitle';

    /**
     * @access public.
     * @var String.
     */
    public $defaultSortDirection = 'ASC';

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'reviews.resources';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('reviews', 'Reviews', $this->modx->getOption('reviews.core_path', null, $this->modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/');

        return parent::initialize();
    }

    /**
     * @access public.
     * @param xPDOQuery $criteria.
     * @return xPDOQuery.
     */
    public function prepareQueryBeforeCount(xPDOQuery $criteria)
    {
        $criteria->setClassAlias('Resource');

        $criteria->select($this->modx->getSelectColumns('modResource', 'Resource', '', ['id', 'pagetitle']));

        $criteria->rightJoin('ReviewsReview', 'Review', [
            'Resource.id = Review.resource_id'
        ]);

        $criteria->groupby('Resource.id');

        return $criteria;
    }

    /**
     * @access public.
     * @param xPDOObject $object.
     * @return Array.
     */
    public function prepareRow(xPDOObject $object)
    {
        return array_merge($object->toArray(), [
            'pagetitle_formatted' => $object->get('pagetitle') . ($this->modx->hasPermission('tree_show_resource_ids') ? ' (' . $object->get('id') . ')' : '')
        ]);
    }
}

return 'ReviewsReviewsResourcesGetListProcessor';
