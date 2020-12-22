<?php
/**
 * @package reviews
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/reviewsrating.class.php');
class ReviewsRating_mysql extends ReviewsRating {}
?>