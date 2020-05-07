<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

require_once dirname(__DIR__) . '/index.class.php';

class ReviewsAdminManagerController extends ReviewsManagerController
{
    /**
     * @access public.
     */
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->modx->reviews->config['js_url'] . 'mgr/widgets/admin.panel.js');

        $this->addJavascript($this->modx->reviews->config['js_url'] . 'mgr/widgets/ratings.grid.js');

        $this->addLastJavascript($this->modx->reviews->config['js_url'] . 'mgr/sections/admin.js');
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
        return $this->modx->reviews->config['templates_path'] . 'admin.tpl';
    }

    /**
     * @access public.
     * @returns Boolean.
     */
    public function checkPermissions()
    {
        return $this->modx->hasPermission('reviews_admin');
    }
}
