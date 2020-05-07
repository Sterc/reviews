<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsResourcesGetListProcessor extends modObjectGetListProcessor
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
    public $defaultSortField = 'pagetitle';

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
        $query = $this->getProperty('query');

        if (!empty($query)) {
            $criteria->where([
                'pagetitle:LIKE'    => '%' . $query . '%',
                'OR:longtitle:LIKE' => '%' . $query . '%'
            ]);
        }

        $context = $this->getProperty('context');

        if (!empty($context)) {
            $criteria->where([
                'context_key:LIKE' => '%' . $context . '%'
            ]);
        }

        foreach ((array) $this->modx->reviews->getOption('include_resources') as $key => $value) {
            if ($key === 'context') {
                $key = 'context_key';
            }

            if (array_key_exists($key, $this->modx->getFields('modResource'))) {
                if (!is_array($value) && strpos($value, ',')) {
                    $value = explode(',', trim($value, ','));
                }

                if (is_array($value)) {
                    $value = array_filter($value);

                    $criteria->where([
                        $key . ':IN' => $value
                    ]);
                } else {
                    $criteria->where([
                        $key => $value
                    ]);
                }
            }
        }

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

return 'ReviewsResourcesGetListProcessor';
