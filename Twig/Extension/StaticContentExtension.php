<?php

namespace QualityPress\Bundle\StaticContentBundle\Twig\Extension;

use \Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;

use QualityPress\Bundle\StaticContentBundle\Manager\ContentManagerInterface;
use QualityPress\Bundle\StaticContentBundle\Manager\ContextManagerInterface;

/**
 * StaticContentExtension
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class StaticContentExtension extends Twig_Extension
{
    
    protected $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function getContainer()
    {
        return $this->container;
    }

    public function getFunctions()
    {
        return array(
            'qp_content_render_content' => new \Twig_Function_Method($this, 'renderContext', array("is_safe" => array("html"))),
            'qp_content_render_context' => new \Twig_Function_Method($this, 'renderContent', array("is_safe" => array("html"))),
        );
    }
    
    public function getName()
    {
        return 'qp_statict_content_extension';
    }
    
    public function renderContext($name, $template, $translationDomain)
    {
    }
    
    public function renderContent($name, $template = null, $translationDomain = null)
    {
        
    }
    
}