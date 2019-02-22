<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modx->addPackage('reviews', $modx->getOption('reviews.core_path', null, $modx->getOption('core_path') . 'components/reviews/') . 'model/');

            $manager = $modx->getManager();

            $manager->createObjectContainer('ReviewsReview');

            break;
    }
}

return true;
