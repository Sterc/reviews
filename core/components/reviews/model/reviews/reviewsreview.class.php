<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsReview extends xPDOSimpleObject
{
    /**
     * @access public.
     * @return String.
     */
    public function getContent()
    {
        $content = $this->get('content');

        if (!empty($content)) {
            if (preg_match('/^<(.*?)>/si', $content)) {
                if (preg_match('/^<(i|em|b|strong|a)(.*?)>/si', $content)) {
                    return '<p>' . $content . '</p>';
                }
            } else {
                return '<p>' . $content . '</p>';
            }
        }

        return $content;
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getRatings()
    {
        $ratings = [];

        foreach ($this->xpdo->getCollection('ReviewsRating') as $rating) {
            $ratings[(int) $rating->get('id')] = 0;
        }

        foreach ($this->getMany('Rating') as $rating) {
            if (isset($ratings[(int) $rating->get('rating_id')])) {
                $ratings[(int) $rating->get('rating_id')] = (int) $rating->get('value');
            }
        }

        return $ratings;
    }

    /**
     * @access public.
     * @return Integer.
     */
    public function getAverage()
    {
        $total      = 0;
        $ratings    = 0;

        foreach ($this->getRatings() as $rating) {
            $total += $rating;

            if ($rating !== 0) {
                $ratings++;
            }
        }

        if ($ratings >= 1) {
            return ceil($total / $ratings);
        }

        return 0;
    }
}
