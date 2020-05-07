<?php

/**
 * Reviews
 *
 * Copyright 2020 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

require_once dirname(__DIR__) . '/index.class.php';

class ReviewsHomeManagerController extends ReviewsManagerController
{
    /**
     * @access public.
     */
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->modx->reviews->config['js_url'] . 'mgr/widgets/home.panel.js');

        $this->addJavascript($this->modx->reviews->config['js_url'] . 'mgr/widgets/reviews.grid.js');

        $this->addLastJavascript($this->modx->reviews->config['js_url'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                Reviews.config.ratings = ' . $this->modx->toJSON($this->modx->reviews->getRatings()) . ';
            });
        </script>');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('reviews');
    }

    /**
     * @access public.
     * @return String.
     */
    public function getTemplateFile()
    {
        return $this->modx->reviews->config['templates_path'] . 'home.tpl';
    }
}
