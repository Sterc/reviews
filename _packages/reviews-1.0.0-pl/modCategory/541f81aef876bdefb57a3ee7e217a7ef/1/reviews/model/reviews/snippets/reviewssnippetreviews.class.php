<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

require_once dirname(__DIR__) . '/reviewssnippets.class.php';

class ReviewsSnippetReviews extends ReviewsSnippets
{
    /**
     * @access public.
     * @var Array.
     */
    public $defaultProperties = [
        'sort'                  => 'createdon',
        'sortDir'               => 'DESC',
        'tpl'                   => '@FILE elements/chunks/item.chunk.tpl',
        'tplWrapper'            => '@FILE elements/chunks/wrapper.chunk.tpl',
        'tplEmpty'              => '',
        'usePdoTools'           => true,
        'usePdoElementsPath'    => false
    ];

    /**
     * @access public.
     * @param Array $properties.
     * @return String.
     */
    public function run(array $properties = [])
    {
        $this->properties = array_merge($this->defaultProperties, $properties);

        $output = [];

        $resourceId = $this->getProperty('id', $this->modx->resource->id);
        list($minRating, $maxRating) = explode('||', $this->config['ratings']);

        $query = $this->modx->newQuery('ReviewsReview', [
            'active' => 1
        ]);

        if (!empty($resourceId)) {
            $query->where([
                'resource_id' => $resourceId
            ]);
        }

        $query->sortby($this->getProperty('sort'), $this->getProperty('sortDir'));

        if (!empty($this->getProperty('limit'))) {
             $query->limit($this->getProperty('limit'));
        }

        $idx            = 1;
        $rating         = 0;
        $totalRating    = 0;
        $totalRatings   = $this->modx->getCount('ReviewsReview', $query);
        $stats          = [];
        $worstRating    = 0;
        $bestRating     = 0;

        for ($i = (int) $minRating; $i <= (int) $maxRating; $i++) {
            $stats[$i] = 0;
        }

        foreach ($this->modx->getCollection('ReviewsReview', $query) as $review) {
            $stats[$review->get('rating')]++;
            $totalRating += (int) $review->get('rating');

            $output[] = $this->getChunk($this->getProperty('tpl'), array_merge($review->toArray(), [
                'idx'       => $idx,
                'minRating' => $minRating,
                'maxRating' => $maxRating,
                'total'     => $totalRatings
            ]));

            if ((int) $review->get('rating') < $worstRating) {
                $worstRating = (int) $review->get('rating');
            } else if ((int) $review->get('rating') > $bestRating) {
                $bestRating = (int) $review->get('rating');
            }

            $idx++;
        }

        if (empty($output) && !empty($this->getProperty('tplEmpty'))) {
            return $this->getChunk($this->getProperty('tplEmpty'));
        }

        if ($totalRating >= 1 && $totalRatings >= 1) {
            $rating = round((int) ($totalRating / $totalRatings));
        }

        if (!empty($this->getProperty('tplWrapper'))) {
            return $this->getChunk($this->getProperty('tplWrapper'), [
                'output'        => implode(PHP_EOL, $output),
                'rating'        => $rating,
                'minRating'     => $minRating,
                'maxRating'     => $maxRating,
                'worstRating'   => $worstRating,
                'bestRating'    => $bestRating,
                'stats'         => $stats,
                'total'         => $totalRatings
            ]);
        }

        return implode(PHP_EOL, $output);
    }
}
