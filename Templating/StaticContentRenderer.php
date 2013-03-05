<?php

namespace QualityPress\Bundle\StaticContentBundle\Templating;

use Symfony\Bundle\TwigBundle\TwigEngine;
use QualityPress\Bundle\StaticContentBundle\Manager\ContentManagerInterface;
use QualityPress\Bundle\StaticContentBundle\Manager\ContextManagerInterface;

/**
 * StaticContentRenderer
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class StaticContentRenderer
{
    
    protected $engine;
    protected $contextManager;
    protected $contentManager;
    
    public function __construct(TwigEngine $engine, ContentManagerInterface $contentManager, ContextManagerInterface $contextManager)
    {
        $this->engine = $engine;
        $this->contentManager = $contentManager;
        $this->contextManager = $contextManager;
    }
    
    public function renderContext()
    {
        
    }
    
    public function renderContent($name, $template = null, $translationDomain = null)
    {
        $contentManager = $this->getContentManager();
        $contextManager = $this->getContextManager();
        
        $content            = $contentManager->findOne($name);
        $template           = ($content && null === $template) ? $contextManager->get($content->getContext())->getTemplate() : null;
        $translationDomain  = ($content && null === $translationDomain) ? $contextManager->get($content->getContext())->getTranslationDomain() : null;
        
        return $this->getTwigEngine()->render($template, array(
            
        ));
    }
    
    /**
     * Get content manager
     * @return ContentManagerInterface
     */
    protected function getContentManager()
    {
        return $this->contentManager;
    }
    
    /**
     * Get context manager
     * @return ContextManagerInterface
     */
    protected function getContextManager()
    {
        return $this->contextManager;
    }
    
    protected function getTwigEngine()
    {
        return $this->engine;
    }
    
}