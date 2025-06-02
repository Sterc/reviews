<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

abstract class ReviewsManagerController extends modExtraManagerController
{
    /** @var Reviews $reviews */
    public $reviews;

    /**
     * @access public.
     */
    public function initialize()
    {
        $this->reviews = $this->modx->getService('reviews', 'Reviews', $this->modx->getOption('reviews.core_path', null, $this->modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/');

        $this->addCss($this->reviews->config['css_url'] . 'mgr/reviews.css');

        $this->addJavascript($this->reviews->config['js_url'] . 'mgr/reviews.js');

        $this->addJavascript($this->reviews->config['js_url'] . 'mgr/extras/extras.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                MODx.config.help_url = "' . $this->reviews->getHelpUrl() . '";
                
                Reviews.config = ' . json_encode(array_merge($this->reviews->config, [
                    'branding_url'      => $this->reviews->getBrandingUrl(),
                    'branding_url_help' => $this->reviews->getHelpUrl()
                ]), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';
            });
        </script>');

        parent::initialize();
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getLanguageTopics()
    {
        return $this->reviews->config['lexicons'];
    }

    /**
     * @access public.
     * @returns Boolean.
     */
    public function checkPermissions()
    {
        return $this->modx->hasPermission('reviews');
    }
}

class IndexManagerController extends ReviewsManagerController
{
    /**
     * @access public.
     * @return String.
     */
    public static function getDefaultController()
    {
        return 'home';
    }
}
