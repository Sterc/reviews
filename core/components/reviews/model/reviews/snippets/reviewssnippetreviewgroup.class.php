<?php

/**
 * Review Group
 *
 * Copyright 2020 by Thomas Jakobi <office@treehillstudio.com>
 */

require_once dirname(__DIR__) . '/reviewssnippets.class.php';

class ReviewsSnippetReviewGroup extends ReviewsSnippets
{
    /**
     * @access public.
     * @var Array.
     */
    public $properties = [
        'type' => 'default',
        'value' => '',
        'required' => false,
        'error' => '',
        'tpl' => '@FILE elements/chunks/formselect.chunk.tpl',
        'tplOption' => '@FILE elements/chunks/formoption.chunk.tpl',
    ];

    /**
     * @access public.
     * @param Array $properties .
     * @return String.
     */
    public function run(array $properties = [])
    {
        $this->setProperties($properties);

        $output = [];

        $type = $this->getProperty('type');
        $value = $this->getProperty('value');
        $error = $this->getProperty('error');
        $required = (bool)$this->getProperty('required');

        /** @var ReviewsRating $ratingType */
        if ($ratingType = $this->modx->getObject('ReviewsRating', [
            'name' => $type
        ])) {
            $range = $this->getRatingRange();
            $options = [];
            foreach ($range as $rating) {
                $options[] = $this->getChunk($this->getProperty('tplOption'), [
                    'rating' => $rating,
                    'value' => $value
                ]);
            }
            return $this->getChunk($this->getProperty('tpl'), [
                'type' => $type,
                'value' => $value,
                'error' => $error,
                'required' => ($required) ? 'required' : '',
                'options' => implode("\n", $options)
            ]);
        }

        return '';
    }
}
