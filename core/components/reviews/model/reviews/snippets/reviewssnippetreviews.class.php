<?php

/**
 * Reviews
 *
 * Copyright 2020 by Thomas Jakobi <office@treehillstudio.com>
 */

require_once dirname(__DIR__) . '/reviewssnippets.class.php';

class ReviewsSnippetReviews extends ReviewsSnippets
{
    /**
     * @access public.
     * @var Array.
     */
    public $properties = [
        'reviews'               => '',

        'limit'                 => 0,
        'where'                 => '{"active": "1"}',
        'sortby'                => '{"createdon": "DESC"}',

        'tpl'                   => '@FILE elements/chunks/item.chunk.tpl',
        'tplWrapper'            => '@FILE elements/chunks/wrapper.chunk.tpl',
        'tplWrapperEmpty'       => '',

        'usePdoTools'           => false,
        'usePdoElementsPath'    => false
    ];

    /**
     * @access public.
     * @param Array $properties.
     * @return String.
     */
    public function run(array $properties = [])
    {
        $this->setProperties($properties);

        $output = [];

        $resourceId = $this->getProperty('id', $this->modx->resource->get('id'));
        $reviewIds  = array_filter(explode(',', $this->getProperty('reviews')));
        $where      = json_decode($this->getProperty('where'), true);
        $sortby     = json_decode($this->getProperty('sortby'), true);
        $limit      = (int) $this->getProperty('limit');

        list($minRating, $maxRating) = explode('||', $this->config['rating_scale']);

        $criteria = $this->modx->newQuery('ReviewsReview');

        if ($where) {
            $criteria->where($where);
        }

        if (count($reviewIds) >= 1) {
            $criteria->where([
                'id:IN' => $reviewIds
            ]);
        } else {
            if ($this->config['resource_aware']) {
                if (!empty($resourceId)) {
                    $criteria->where([
                        'resource_id' => $resourceId
                    ]);
                }
            }
        }

        if ($sortby) {
            foreach ((array) $sortby as $key => $value) {
                if (in_array($value, ['RAND', 'RAND()'], true)) {
                    $criteria->sortby('RAND()');
                } else {
                    $criteria->sortby($key, $value);
                }
            }
        }

        if ($limit > 1) {
            $criteria->limit($limit);
        }

        $idx            = 1;
        $average        = 0;
        $totalRating    = 0;
        $totalRatings   = $this->modx->getCount('ReviewsReview', $criteria);
        $ratingTypes    = [];
        $ratingStats    = [];
        $stats          = array_fill_keys($this->getRatingRange(), 0);

        foreach ($this->getRatings() as $rating) {
            $ratingTypes[(int) $rating['id']] = $rating;
            $ratingStats[(int) $rating['id']] = array_merge($rating, [
                'value' => 0
            ]);
        }

        /** @var ReviewsReview $review */
        foreach ($this->modx->getCollection('ReviewsReview', $criteria) as $review) {
            $reviewAverage = round($review->getAverage());
            $stats[$reviewAverage] +=1;
            $totalRating += $reviewAverage;

            $output[] = $this->getChunk($this->getProperty('tpl'), array_merge($review->toArray(), [
                'idx'           => $idx,
                'average'       => $reviewAverage,
                'minRating'     => $minRating,
                'maxRating'     => $maxRating,
                'totalRatings'  => $totalRatings,
                'ratings'       => $review->getRatings(),
                'ratingTypes'   => $ratingTypes,
                'content'       => $review->getContent()
            ]));

            foreach ((array) $review->getRatings() as $key => $rating) {
                $ratingStats[(int) $key]['value'] += (int) $rating;
            }

            $idx++;
        }

        if ($totalRating >= 1 && $totalRatings >= 1) {
            $average = ceil($totalRating / $totalRatings);
        }

        foreach ($ratingStats as $key => $value) {
            $ratingStats[$key]['value'] = ceil($value['value'] / $totalRatings);
        }

        if (!empty($output)) {
            $tplWrapper = $this->getProperty('tplWrapper');

            if (!empty($tplWrapper)) {
                return $this->getChunk($tplWrapper, [
                    'output'        => implode(PHP_EOL, $output),
                    'average'       => $average,
                    'minRating'     => $minRating,
                    'maxRating'     => $maxRating,
                    'ratingTypes'   => $ratingTypes,
                    'ratingStats'   => $ratingStats,
                    'stats'         => $stats,
                    'total'         => $totalRatings
                ]);
            }

            return implode(PHP_EOL, $output);
        }

        $tplWrapperEmpty = $this->getProperty('tplWrapperEmpty');

        if (!empty($tplWrapperEmpty)) {
            return $this->getChunk($tplWrapperEmpty);
        }

        return '';
    }
}
