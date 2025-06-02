<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

$_lang['reviews']                                       = 'Reviews';
$_lang['reviews.desc']                                  = 'Manage all reviews.';

$_lang['area_reviews']                                  = 'Reviews';

$_lang['setting_reviews.branding_url']                  = 'Branding';
$_lang['setting_reviews.branding_url_desc']             = 'The URL of the branding button, if the URL is empty the branding button won\'t be shown.';
$_lang['setting_reviews.branding_url_help']             = 'Branding (help)';
$_lang['setting_reviews.branding_url_help_desc']        = 'The URL of the branding help button, if the URL is empty the branding help button won\'t be shown.';
$_lang['setting_reviews.ratings']                       = 'Ratings';
$_lang['setting_reviews.ratings_desc']                  = 'The min and max rating that can be given. Default is "1||5".';
$_lang['setting_reviews.resource_aware']                = 'Resource aware';
$_lang['setting_reviews.resource_aware_desc']           = 'If "Yes" the reviews are aware of a resource.';
$_lang['setting_reviews.include_resources']             = 'Limit resources';
$_lang['setting_reviews.include_resources_desc']        = 'Pages that meet this value are displayed will be shown in the \'resources\' combo box. This must be a valid JSON. Default is "[]".';
$_lang['setting_reviews.use_editor']                    = 'Use rich text editor';
$_lang['setting_reviews.use_editor_desc']               = 'Use a rich text editor for the reviews.';

$_lang['reviews.review']                                = 'Review';
$_lang['reviews.reviews']                               = 'Reviews';
$_lang['reviews.reviews_desc']                          = 'Manage all reviews.';
$_lang['reviews.review_create']                         = 'Create review';
$_lang['reviews.review_update']                         = 'Update review';
$_lang['reviews.review_remove']                         = 'Remove review';
$_lang['reviews.review_remove_confirm']                 = 'Are you sure you want to remove this review? Because of this, he is no longer included in the statistics.';
$_lang['reviews.review_activate']                       = 'Activate review';
$_lang['reviews.review_activate_confirm']               = 'Are you sure you want to activate this review? Because of this, he is included again in the statistics.';
$_lang['reviews.review_deactivate']                     = 'Deactivate review';
$_lang['reviews.review_deactivate_confirm']             = 'Are you sure you want to deactivate this review? Because of this, he is no longer included in the statistics.';

$_lang['reviews.rating']                                = 'Rating';
$_lang['reviews.ratings']                               = 'Ratings';
$_lang['reviews.ratings_desc']                          = 'Manage all possible ratings.';
$_lang['reviews.rating_create']                         = 'Create rating';
$_lang['reviews.rating_update']                         = 'Update rating';
$_lang['reviews.rating_remove']                         = 'Remove rating';
$_lang['reviews.rating_remove_confirm']                 = 'Are you sure you want to remove this rating?';

$_lang['reviews.label_review_resource']                 = 'Resource';
$_lang['reviews.label_review_resource_desc']            = 'The resource of the review.';
$_lang['reviews.label_review_name']                     = 'Name';
$_lang['reviews.label_review_name_desc']                = 'The name of the reviewer.';
$_lang['reviews.label_review_email']                    = 'Email address';
$_lang['reviews.label_review_email_desc']               = 'The email adress of the reviewer.';
$_lang['reviews.label_review_city']                     = 'City';
$_lang['reviews.label_review_city_desc']                = 'The city of the reviewer.';
$_lang['reviews.label_review_rating']                   = 'Score';
$_lang['reviews.label_review_rating_desc']              = 'The score for \'[[+name]]\'.';
$_lang['reviews.label_review_average_rating']           = 'Average score';
$_lang['reviews.label_review_average_rating_desc']      = 'The average score for \'[[+name]]\'.';
$_lang['reviews.label_review_content']                  = 'Review';
$_lang['reviews.label_review_content_desc']             = 'The review.';
$_lang['reviews.label_review_active']                   = 'Active';
$_lang['reviews.label_review_active_desc']              = '';

$_lang['reviews.label_rating_name']                     = 'Name';
$_lang['reviews.label_rating_name_desc']                = 'The name of the rating.';
$_lang['reviews.label_rating_active']                   = 'Active';
$_lang['reviews.label_rating_active_desc']              = '';

$_lang['reviews.default_view']                          = 'Default view';
$_lang['reviews.admin_view']                            = 'Admin view';
$_lang['reviews.filter_resource']                       = 'Filter on resource';
$_lang['reviews.no_resource']                           = 'No resource';
$_lang['reviews.rating_0']                              = 'No rating';
$_lang['reviews.rating_1']                              = 'star';
$_lang['reviews.rating_2']                              = 'stars';
$_lang['reviews.rating_3']                              = 'stars';
$_lang['reviews.rating_4']                              = 'stars';
$_lang['reviews.rating_5']                              = 'stars';
$_lang['reviews.average']                               = 'Average';
$_lang['reviews.title']                                 = 'Review ([[+total]] total)';
$_lang['reviews.review_title']                          = 'Review [[+idx]] of [[+total]] by';
$_lang['reviews.no_reviews']                            = 'There no reviews available for this resource.';

$_lang['reviews.hook_error_overwrite']                  = 'There exists already a rating with this name and email address!';
$_lang['reviews.hook_error_rating_range']               = 'Unfortunately, the rating is outside the rating range!';