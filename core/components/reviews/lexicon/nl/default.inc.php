<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

$_lang['reviews']                                       = 'Reviews';
$_lang['reviews.desc']                                  = 'Beheer hier reviews.';

$_lang['area_reviews']                                  = 'Reviews';

$_lang['setting_reviews.branding_url']                  = 'Branding';
$_lang['setting_reviews.branding_url_desc']             = 'De URL waar de branding knop heen verwijst, indien leeg wordt de branding knop niet getoond.';
$_lang['setting_reviews.branding_url_help']             = 'Branding (help)';
$_lang['setting_reviews.branding_url_help_desc']        = 'De URL waar de branding help knop heen verwijst, indien leeg wordt de branding help knop niet getoond.';
$_lang['setting_reviews.ratings']                       = 'Beoordelingen';
$_lang['setting_reviews.ratings_desc']                  = 'De min en max beoordeling wat gegeven kan worden. Standaard is "1||5".';
$_lang['setting_reviews.resource_aware']                = 'Pagina afhankelijk';
$_lang['setting_reviews.resource_aware_desc']           = 'Indien "Ja" dan zijn de reviews afhankelijk van een pagina.';
$_lang['setting_reviews.include_resources']             = 'Pagina\'s limiteren';
$_lang['setting_reviews.include_resources_desc']        = 'Pagina\'s die voldoen aan deze waarde worden getoond in de  \'pagina\' combo box. Dit moet een geldig JSON formaat zijn. Standaard is "[]".';
$_lang['setting_reviews.use_editor']                    = 'Gebruik richt text editor';
$_lang['setting_reviews.use_editor_desc']               = 'Gebruik een rich text editor voor de reviews.';

$_lang['reviews.review']                                = 'Review';
$_lang['reviews.reviews']                               = 'Reviews';
$_lang['reviews.reviews_desc']                          = 'Beheer alle reviews.';
$_lang['reviews.review_create']                         = 'Nieuwe review';
$_lang['reviews.review_update']                         = 'Review wijzigen';
$_lang['reviews.review_remove']                         = 'Review verwijderen';
$_lang['reviews.review_remove_confirm']                 = 'Weet je zeker dat je deze review wilt verwijderen? Hierdoor wordt hij ook niet meer in de statistieken meegenomen.';
$_lang['reviews.review_activate']                       = 'Review activeren';
$_lang['reviews.review_activate_confirm']               = 'Weet je zeker dat je deze review wilt activeren? Hierdoor wordt hij ook weer in de statistieken getoond.';
$_lang['reviews.review_deactivate']                     = 'Review deactiveren';
$_lang['reviews.review_deactivate_confirm']             = 'Weet je zeker dat je deze review wilt deactiveren? Hierdoor wordt hij ook niet meer in de statistieken getoond.';

$_lang['reviews.rating']                                = 'Beoordeling';
$_lang['reviews.ratings']                               = 'Beoordelingen';
$_lang['reviews.ratings_desc']                          = 'Beheer alle mogelijke beoordelingen.';
$_lang['reviews.rating_create']                         = 'Nieuwe beoordeling';
$_lang['reviews.rating_update']                         = 'Beoordeling wijzigen';
$_lang['reviews.rating_remove']                         = 'Beoordeling verwijderen';
$_lang['reviews.rating_remove_confirm']                 = 'Weet je zeker dat je deze beoordeling wilt verwijderen?';

$_lang['reviews.label_review_resource']                 = 'Pagina';
$_lang['reviews.label_review_resource_desc']            = 'De pagina van de review.';
$_lang['reviews.label_review_name']                     = 'Naam';
$_lang['reviews.label_review_name_desc']                = 'De naam van de reviewer.';
$_lang['reviews.label_review_email']                    = 'E-mailadres';
$_lang['reviews.label_review_email_desc']               = 'Het e-mailadres van de reviewer.';
$_lang['reviews.label_review_city']                     = 'Woonplaants';
$_lang['reviews.label_review_city_desc']                = 'De woonplaats van de reviewer.';
$_lang['reviews.label_review_rating']                   = 'Score';
$_lang['reviews.label_review_rating_desc']              = 'De score voor \'[[+name]]\'.';
$_lang['reviews.label_review_average_rating']           = 'Gemiddelde score';
$_lang['reviews.label_review_average_rating_desc']      = 'De gemiddelde score voor \'[[+name]]\'.';
$_lang['reviews.label_review_content']                  = 'Review';
$_lang['reviews.label_review_content_desc']             = 'De review.';
$_lang['reviews.label_review_active']                   = 'Actief';
$_lang['reviews.label_review_active_desc']              = '';

$_lang['reviews.label_rating_name']                     = 'Naam';
$_lang['reviews.label_rating_name_desc']                = 'De naam van de rating.';
$_lang['reviews.label_rating_active']                   = 'Actief';
$_lang['reviews.label_rating_active_desc']              = '';

$_lang['reviews.default_view']                          = 'Standaard weergave';
$_lang['reviews.admin_view']                            = 'Admin weergave';
$_lang['reviews.filter_resource']                       = 'Filter op pagina';
$_lang['reviews.no_resource']                           = 'Geen pagina';
$_lang['reviews.rating_0']                              = 'Geen oordeel';
$_lang['reviews.rating_1']                              = 'ster';
$_lang['reviews.rating_2']                              = 'sterren';
$_lang['reviews.rating_3']                              = 'sterren';
$_lang['reviews.rating_4']                              = 'sterren';
$_lang['reviews.rating_5']                              = 'sterren';
$_lang['reviews.average']                               = 'Gemiddelde';
$_lang['reviews.title']                                 = 'Beoordelingen';
$_lang['reviews.review_title']                          = 'Beoordeling [[+idx]] van [[+total]] door';
$_lang['reviews.no_reviews']                            = 'Er zijn geen beoordelingen voor deze pagina.';

$_lang['reviews.hook_error_overwrite']                  = 'Er is al een recensie met deze naam en dit e-mailadres!';
$_lang['reviews.hook_error_rating_range']               = 'Helaas ligt de rating buiten het beoordelingsbereik!';