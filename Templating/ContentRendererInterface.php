<?php

namespace QualityPress\Bundle\StaticContentBundle\Templating;

/**
 * ContentRendererInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface ContentRendererInterface
{
    
    /**
     * Get rendered content
     * 
     * @param string    $template
     * @param array     $parameters
     * @return string
     */
    function render($template, array $parameters);
    
}
