<?php

namespace QualityPress\Bundle\StaticContentBundle\Twig\Extension;

use \Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;
use QualityPress\Bundle\StaticContentBundle\Templating\ContentRendererInterface;
use QualityPress\Bundle\StaticContentBundle\Handler\ContentHandlerInterface;
use QualityPress\Bundle\StaticContentBundle\Handler\ContextHandlerInterface;
use QualityPress\Bundle\StaticContentBundle\Exception\ContentNotFoundException;

use QualityPress\Bundle\StaticContentBundle\Model\ContentInterface;

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
            'qp_get_content'                => new \Twig_Function_Method($this, 'getContent', array("is_safe" => array("html"))),
            'qp_get_contents_by_context'    => new \Twig_Function_Method($this, 'getContentsByContext', array("is_safe" => array("html"))),
           
            'qp_render_content'             => new \Twig_Function_Method($this, 'renderContent', array("is_safe" => array("html"))),
            'qp_render_contents_by_context' => new \Twig_Function_Method($this, 'renderContentsByContext', array("is_safe" => array("html"))),
            
            'qp_get_description_by_context' => new \Twig_Function_Method($this, 'getContextDescription', array("is_safe" => array("html"))),
        );
    }
    
    /**
     * Extension name
     * @return string
     */
    public function getName()
    {
        return 'qp_static_content_extension';
    }
    
    /**
     * Get content object
     * 
     * @param string $name
     * @return ContentInterface
     * @throws ContentNotFoundException
     */
    public function getContent($name)
    {
        $contentHandler = $this->getContentHandler();
        $content = $contentHandler->get($name);
        
        if (null == $content) {
            throw new ContentNotFoundException(sprintf(
                'The valid contents obtained are:',
                join(',', array_keys($contentHandler->getContents()))
            ));
        }
        
        return $content;
    }
    
    /**
     * Get content rendered
     * 
     * @param string    $name
     * @param string    $template
     * @param array     $options
     * @return string Rendered content
     */
    public function renderContent($name, $template = null, $options = array())
    {
        $content    = $this->getContent($name);
        $template   = (null === $template) ? $this->getContextHandler()->get($content->getContext())->getTemplate() : $template;
        if (false === isset($options['translationDomain'])) {
            $options = array_merge(
                array('translationDomain' => $this->getContextHandler()->get($content->getContext())->getTranslationDomain()),
                $options
            );
        }
        
        return $this->getTemplateRenderer()->render($template, array_merge(array('content' => $content), $options));
    }
    
    /**
     * Render all contents by context name
     * 
     * @param string $name
     * @param string $template
     * @param array $options
     * 
     * @return string
     */
    public function renderContentsByContext($name, $template = null, $options = array())
    {
        $return = '';
        foreach ($this->getContentsByContext($name) as $content) {
            $return .= $this->renderContent($content->getIdent(), $template, $options);
        }
        
        return $return;
    }
    
    /**
     * Get all contents by context name
     * 
     * @param string $name
     * @return mixed array|null
     */
    public function getContentsByContext($name)
    {
        $contextHandler = $this->getContextHandler();
        return ($contextHandler->has($name)) ? $this->getContentHandler()->getByContext($name) : array();
    }
    
    /**
     * Get description of context
     * 
     * @param   string $name
     * @return  string
     */
    public function getContextDescription($name)
    {
        return ($this->getContextHandler()->has($name)) ? $this->getContextHandler()->get($name)->getDescription() : '';
    }
    
    /**
     * Get content handler object
     * @return ContentHandlerInterface
     */
    protected function getContentHandler()
    {
        return $this->getContainer()->get('qp.static_content.content_handler');
    }
    
    /**
     * Get context handler object
     * @return ContextHandlerInterface
     */
    protected function getContextHandler()
    {
        return $this->getContainer()->get('qp.static_content.context_handler');
    }
    
    /**
     * Get content render object
     * @return ContentRendererInterface
     */
    protected function getTemplateRenderer()
    {
        return $this->getContainer()->get('qp.static_content.renderer');
    }
    
}