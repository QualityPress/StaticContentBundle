<?php

namespace QualityPress\Bundle\StaticContentBundle\Model;

/**
 * Context
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class Context implements ContextInterface
{
    
    protected $template;
    protected $translationDomain;

    public function getTemplate()
    {
        return $this->template;
    }
    
    public function getTranslationDomain()
    {
        return $this->translationDomain;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    
    public function setTranslationDomain($translationDomain)
    {
        $this->translationDomain = $translationDomain;
        return $this;
    }
    
}