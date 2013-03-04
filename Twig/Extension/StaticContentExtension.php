<?php

namespace QualityPress\Bundle\StaticContentBundle\Twig\Extension;

use \Twig_Extension;

/**
 * StaticContentExtension
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class StaticContentExtension extends Twig_Extension
{

    public function getFunctions()
    {
        return array(
            'qp_breadcrumbs_render_content' => new \Twig_Function_Method($this, 'renderContext', array("is_safe" => array("html"))),
            'qp_breadcrumbs_render_context' => new \Twig_Function_Method($this, 'renderContent', array("is_safe" => array("html"))),
        );
    }
    
    public function getName()
    {
        return 'qp_statict_content_extension';
    }
    
    public function renderContext($context)
    {
        
    }
    
    public function renderContent($content)
    {
        
    }
    
}