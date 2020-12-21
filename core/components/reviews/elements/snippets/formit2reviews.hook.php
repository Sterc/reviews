<?php
/**
 * Formit2Reviews
 *
 * Copyright 2020 by Thomas Jakobi <office@treehillstudio.com>
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @var fiHooks $hook
 */

$class = $modx->loadClass('ReviewsHookFormit2Reviews', $modx->getOption('reviews.core_path', null, $modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/snippets/', false, true);

if ($class) {
    $instance = new $class($modx);

    if ($instance instanceof ReviewsSnippets) {
        return $instance->run($scriptProperties, $hook);
    }
}

return true;