<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

require_once dirname(dirname(dirname(__DIR__))) . '/config.core.php';

require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$modx->getService('reviews', 'Reviews', $modx->getOption('reviews.core_path', null, $modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/');

if ($modx->reviews instanceof Reviews) {
    $modx->request->handleRequest([
        'processors_path'   => $modx->reviews->config['processors_path'],
        'location'          => ''
    ]);
}
