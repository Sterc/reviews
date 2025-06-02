<?php
/**
 * @package reviews
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/reviewsreview.class.php');
class ReviewsReview_mysql extends ReviewsReview {}
?>