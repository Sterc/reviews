<?php

/**
 * Reviews
 *
 * Copyright 2018 by Oene Tjeerd de Bruin <oenetjeerd@sterc.nl>
 */

require_once dirname(__DIR__) . '/index.class.php';

class ReviewsHomeManagerController extends ReviewsManagerController
{
    /**
     * @access public.
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->modx->reviews->config['css_url'] . 'mgr/reviews.css');

        $this->addJavascript($this->modx->reviews->config['js_url'] . 'mgr/widgets/home.panel.js');

        $this->addJavascript($this->modx->reviews->config['js_url'] . 'mgr/widgets/reviews.grid.js');

        $this->addLastJavascript($this->modx->reviews->config['js_url'] . 'mgr/sections/home.js');
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

    /**
     * @access public.
     * @param Array $scriptProperties.
     */
    public function process(array $scriptProperties = [])
    {
        $useEditor = $this->modx->getOption('use_editor');
        $whichEditor = $this->modx->getOption('which_editor');

        if ($useEditor && !empty($whichEditor)) {
            $onRichTextEditorInit = $this->modx->invokeEvent('OnRichTextEditorInit', [
                'editor'    => $whichEditor,
                'elements'  => []
            ]);

            if (is_array($onRichTextEditorInit)) {
                $onRichTextEditorInit = implode('', $onRichTextEditorInit);
            }

            $this->setPlaceholder('onRichTextEditorInit', $onRichTextEditorInit);
        }
    }
}
