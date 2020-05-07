<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

abstract class ReviewsManagerController extends modExtraManagerController
{
    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('reviews', 'Reviews', $this->modx->getOption('reviews.core_path', null, $this->modx->getOption('core_path') . 'components/reviews/') . 'model/reviews/');

        $this->addCss($this->modx->reviews->config['css_url'] . 'mgr/reviews.css');

        $this->addJavascript($this->modx->reviews->config['js_url'] . 'mgr/reviews.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                MODx.config.help_url = "' . $this->modx->reviews->getHelpUrl() . '";
                
                Reviews.config = ' . $this->modx->toJSON(array_merge($this->modx->reviews->config, [
                    'branding_url'      => $this->modx->reviews->getBrandingUrl(),
                    'branding_url_help' => $this->modx->reviews->getHelpUrl()
                ])) . ';
            });
        </script>');

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Array.
     */
    public function getLanguageTopics()
    {
        return $this->modx->reviews->config['lexicons'];
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
