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
        $this->addJavascript($this->reviews->config['js_url'] . 'mgr/widgets/home.panel.js');

        $this->addJavascript($this->reviews->config['js_url'] . 'mgr/widgets/reviews.grid.js');

        $this->addLastJavascript($this->reviews->config['js_url'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                Reviews.config.ratings = ' . $this->modx->toJSON($this->reviews->getRatings()) . ';
            });
        </script>');

        if ($this->reviews->getOption('use_editor')) {
            $this->loadRichTextEditor();
        }
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
        return $this->reviews->config['templates_path'] . 'home.tpl';
    }

    /**
     * Load rich text editor.
     */
    public function loadRichTextEditor()
    {
        $useEditor = $this->modx->getOption('use_editor');
        $whichEditor = $this->modx->getOption('which_editor');
        if ($useEditor && !empty($whichEditor)) {
            $onRichTextEditorInit = $this->modx->invokeEvent('OnRichTextEditorInit', [
                'editor' => $whichEditor
            ]);
            if (is_array($onRichTextEditorInit)) {
                $onRichTextEditorInit = implode('', $onRichTextEditorInit);
            }
            $this->addHtml($onRichTextEditorInit);
        }
    }
}
