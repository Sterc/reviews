<?php
/**
 * @package reviews
 */
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/reviewsreviewrating.class.php');
class ReviewsReviewRating_mysql extends ReviewsReviewRating {}
?>