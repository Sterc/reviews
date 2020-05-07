<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class ReviewsRating extends xPDOSimpleObject
{
    /**
     * @access Public.
     * @return String.
     */
    public function getName()
    {
        $key        = 'rating_reviews.' . strtolower($this->get('name'));
        $lexicon    = $this->xpdo->lexicon($key);

        if ($key !== $lexicon) {
            return $lexicon;
        }

        return $this->get('name');
    }
}
