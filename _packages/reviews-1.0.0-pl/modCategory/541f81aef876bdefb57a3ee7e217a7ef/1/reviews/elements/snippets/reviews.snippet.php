<?php
/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

$instance = $modx->getService('ReviewsSnippetReviews', 'ReviewsSnippetReviews', $modx->getOption('reviews.core_path', null, $modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/snippets/');

if ($instance instanceof ReviewsSnippetReviews) {
    return $instance->run($scriptProperties);
}

return '';