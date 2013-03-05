<?php

namespace QualityPress\Bundle\StaticContentBundle\Model;

/**
 * ContextInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContextInterface
{
 
    /**
     * Set template
     * 
     * @param string $template
     * @return self
     */
    function setTemplate($template);
    
    /**
     * Get template
     * 
     * @return string
     */
    function getTemplate();
    
    /**
     * Set translation domain
     * 
     * @param string $translationDomain
     * @return self
     */
    function setTranslationDomain($translationDomain);
    
    /**
     * Get translationDomain
     * 
     * @return string
     */
    function getTranslationDomain();
    
    /**
     * Set description of context
     * 
     * @param string $description
     * return self
     */
    function setDescription($description);
    
    /**
     * Get context description
     * 
     * @return string
     */
    function getDescription();
    
}
