<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

class Reviews
{
    /**
     * @access public.
     * @var Object.
     */
    public $modx;

    /**
     * @access public.
     * @var Array.
     */
    public $config = [];

    /**
     * @access public.
     * @param modX $modx.
     * @param Array $config.
     */
    public function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;

        $corePath   = $this->modx->getOption('reviews.core_path', $config, $this->modx->getOption('core_path') . 'components/reviews/');
        $assetsUrl  = $this->modx->getOption('reviews.assets_url', $config, $this->modx->getOption('assets_url') . 'components/reviews/');
        $assetsPath = $this->modx->getOption('reviews.assets_path', $config, $this->modx->getOption('assets_path') . 'components/reviews/');

        $this->config = array_merge([
            'namespace'             => 'reviews',
            'lexicons'              => ['reviews:default'],
            'base_path'             => $corePath,
            'core_path'             => $corePath,
            'model_path'            => $corePath . 'model/',
            'processors_path'       => $corePath . 'processors/',
            'elements_path'         => $corePath . 'elements/',
            'chunks_path'           => $corePath . 'elements/chunks/',
            'plugins_path'          => $corePath . 'elements/plugins/',
            'snippets_path'         => $corePath . 'elements/snippets/',
            'templates_path'        => $corePath . 'templates/',
            'assets_path'           => $assetsPath,
            'js_url'                => $assetsUrl . 'js/',
            'css_url'               => $assetsUrl . 'css/',
            'assets_url'            => $assetsUrl,
            'connector_url'         => $assetsUrl . 'connector.php',
            'version'               => '1.0.0',
            'branding_url'          => $this->modx->getOption('reviews.branding_url'),
            'branding_help_url'     => $this->modx->getOption('reviews.branding_url_help'),
            'ratings'               => $this->modx->getOption('reviews.ratings', null, '1||5')
        ], $config);

        $this->modx->addPackage('reviews', $this->config['model_path']);

        if (is_array($this->config['lexicons'])) {
            foreach ($this->config['lexicons'] as $lexicon) {
                $this->modx->lexicon->load($lexicon);
            }
        } else {
            $this->modx->lexicon->load($this->config['lexicons']);
        }
    }

    /**
     * @access public.
     * @return String|Boolean.
     */
    public function getHelpUrl()
    {
        $url = $this->getOption('branding_url_help');

        if (!empty($url)) {
            return $url . '?v=' . $this->config['version'];
        }

        return false;
    }

    /**
     * @access public.
     * @return String|Boolean.
     */
    public function getBrandingUrl()
    {
        $url = $this->getOption('branding_url');

        if (!empty($url)) {
            return $url;
        }

        return false;
    }

    /**
     * @access public.
     * @param String $key.
     * @param Array $options.
     * @param Mixed $default.
     * @return Mixed.
     */
    public function getOption($key, array $options = [], $default = null)
    {
        if (isset($options[$key])) {
            return $options[$key];
        }

        if ($this->config[$key]) {
            return $this->config[$key];
        }

        return $this->modx->getOption($this->config['namespace'] . '.' . $key, $options, $default);
    }
}
