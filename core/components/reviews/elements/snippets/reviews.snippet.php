<?php
/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$class = $modx->loadClass('ReviewsSnippetReviews', $modx->getOption('reviews.core_path', null, $modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/snippets/', false, true);

if ($class) {
    $instance = new $class($modx);

    if ($instance instanceof ReviewsSnippets) {
        return $instance->run($scriptProperties);
    }
}

return '';