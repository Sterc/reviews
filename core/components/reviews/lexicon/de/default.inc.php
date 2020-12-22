<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

$_lang['reviews'] = 'Rezensionen';
$_lang['reviews.desc'] = 'Alle Rezensionen verwalten';

$_lang['area_reviews'] = 'Rezensionen';

$_lang['setting_reviews.branding_url'] = 'Branding';
$_lang['setting_reviews.branding_url_desc'] = 'Die URL der Branding-Schaltfläche, wenn die URL leer ist, wird die Branding-Schaltfläche nicht angezeigt.';
$_lang['setting_reviews.branding_url_help'] = 'Branding (Hilfe)';
$_lang['setting_reviews.branding_url_help_desc'] = 'Die URL der Branding-Hilfeschaltfläche, wenn die URL leer ist, wird die Branding-Hilfeschaltfläche nicht angezeigt.';
$_lang['setting_reviews.ratings'] = 'Bewertungen';
$_lang['setting_reviews.ratings_desc'] = 'Die minimale und maximale Bewertung, die abgegeben werden kann. Standard ist "1||5".';
$_lang['setting_reviews.resource_aware'] = 'Ressourcenbewusst';
$_lang['setting_reviews.resource_aware_desc'] = 'Wenn "Ja", sind die Bewertungen einer Ressource bewusst.';
$_lang['setting_reviews.include_resources'] = 'Ressourcen einschränken';
$_lang['setting_reviews.include_resources_desc'] = 'Seiten, die diesen Wert erfüllen, werden im Auswahlfeld "Ressourcen" angezeigt. Dies muss ein gültiges JSON sein. Standard ist "[]".';
$_lang['setting_reviews.use_editor'] = 'Rich-Text-Editor verwenden';
$_lang['setting_reviews.use_editor_desc'] = 'Einen Rich-Text-Editor für die Rezensionen verwenden.';

$_lang['reviews.review'] = 'Rezension';
$_lang['reviews.reviews'] = 'Rezensionen';
$_lang['reviews.reviews_desc'] = 'Rezensionen verwalten.';
$_lang['reviews.review_create'] = 'Rezension erstellen';
$_lang['reviews.review_update'] = 'Rezension aktualisieren';
$_lang['reviews.review_remove'] = 'Rezension entfernen';
$_lang['reviews.review_remove_confirm'] = 'Sind Sie sicher, dass Sie diese Rezension entfernen möchten? Dadurch wird er nicht mehr in die Statistik aufgenommen.';
$_lang['reviews.review_activate'] = 'Rezension aktivieren';
$_lang['reviews.review_activate_confirm'] = 'Sind Sie sicher, dass Sie diese Rezension aktivieren wollen? Dadurch wird er wieder in die Statistik aufgenommen.';
$_lang['reviews.review_deactivate'] = 'Rezension deaktivieren';
$_lang['reviews.review_deactivate_confirm'] = 'Sind Sie sicher, dass Sie diese Rezension deaktivieren möchten? Dadurch wird er nicht mehr in die Statistik aufgenommen.';

$_lang['reviews.rating'] = 'Bewertung';
$_lang['reviews.ratings'] = 'Bewertungen';
$_lang['reviews.ratings_desc'] = 'Bewertungen verwalten.';
$_lang['reviews.rating_create'] = 'Bewertung erstellen';
$_lang['reviews.rating_update'] = 'Bewertung aktualisieren';
$_lang['reviews.rating_remove'] = 'Bewertung entfernen';
$_lang['reviews.rating_remove_confirm'] = 'Sind Sie sicher, dass Sie diese Bewertung entfernen möchten?';

$_lang['reviews.label_review_resource'] = 'Ressource';
$_lang['reviews.label_review_resource_desc'] = 'Die Ressource der Bewertung.';
$_lang['reviews.label_review_name'] = 'Name';
$_lang['reviews.label_review_name_desc'] = 'Der Name des Rezensenten.';
$_lang['reviews.label_review_email'] = 'E-Mail Adresse';
$_lang['reviews.label_review_email_desc'] = 'Die E-Mail-Adresse des Rezensenten.';
$_lang['reviews.label_review_city'] = 'Stadt';
$_lang['reviews.label_review_city_desc'] = 'Die Stadt des Rezensenten.';
$_lang['reviews.label_review_rating'] = 'Bewertung';
$_lang['reviews.label_review_rating_desc'] = 'Die Punktzahl für \'[[+name]]\'.';
$_lang['reviews.label_review_average_rating'] = 'Durchschnittliche Punktzahl';
$_lang['reviews.label_review_average_rating_desc'] = 'Die durchschnittliche Punktzahl für \'[[+name]]\'.';
$_lang['reviews.label_review_content'] = 'Rezension';
$_lang['reviews.label_review_content_desc'] = 'Die Rezension.';
$_lang['reviews.label_review_active'] = 'Aktiv';
$_lang['reviews.label_review_active_desc'] = '';

$_lang['reviews.label_rating_name'] = 'Name';
$_lang['reviews.label_rating_name_desc'] = 'Der Name der Bewertung.';
$_lang['reviews.label_rating_active'] = 'Aktiv';
$_lang['reviews.label_rating_active_desc'] = '';

$_lang['reviews.default_view'] = 'Standard-Ansicht';
$_lang['reviews.admin_view'] = 'Admin-Ansicht';
$_lang['reviews.filter_resource'] = 'Nach Ressourcen filtern';
$_lang['reviews.no_resource'] = 'Keine Ressource';
$_lang['reviews.rating_0'] = 'Keine Bewertung';
$_lang['reviews.rating_1'] = 'Stern';
$_lang['reviews.rating_2'] = 'Sterne';
$_lang['reviews.rating_3'] = 'Sterne';
$_lang['reviews.rating_4'] = 'Sterne';
$_lang['reviews.rating_5'] = 'Sterne';
$_lang['reviews.average'] = 'Durchschnitt';
$_lang['reviews.title'] = 'Rezension ([[+total]] total)';
$_lang['reviews.review_title'] = 'Rezension [[+idx]] von [[+total]] von';
$_lang['reviews.no_reviews'] = 'Für diese Ressource sind keine Rezensionen vorhanden.';

$_lang['reviews.hook_error_overwrite'] = 'Es existiert bereits eine Bewertung mit diesem Namen und dieser E-Mail-Adresse!';
$_lang['reviews.hook_error_rating_range'] = 'Leider liegt die Bewertung außerhalb des Bewertungsbereichs!';