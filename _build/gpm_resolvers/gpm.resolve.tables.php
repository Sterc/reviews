<?php
/**
 * Resolve creating db tables
 *
 * THIS RESOLVER IS AUTOMATICALLY GENERATED, NO CHANGES WILL APPLY
 *
 * @package reviews
 * @subpackage build
 *
 * @var mixed $object
 * @var modX $modx
 * @var array $options
 */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modelPath = $modx->getOption('reviews.core_path', null, $modx->getOption('core_path') . 'components/reviews/') . 'model/';
            
            $modx->addPackage('reviews', $modelPath, null);


            $manager = $modx->getManager();

            $manager->createObjectContainer('ReviewsReview');
            $manager->createObjectContainer('ReviewsReviewRating');
            $manager->createObjectContainer('ReviewsRating');

            break;
    }
}

return true;