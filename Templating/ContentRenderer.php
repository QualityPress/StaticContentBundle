<?php

namespace QualityPress\Bundle\StaticContentBundle\Templating;

use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * ContentRenderer
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class ContentRenderer implements ContentRendererInterface
{
    
    protected $engine;
    
    public function __construct(TwigEngine $engine)
    {
        $this->engine = $engine;
    }
    
    protected function getTwigEngine()
    {
        return $this->engine;
    }
    
    public function render($template, array $parameters)
    {
        return $this->getTwigEngine()->render($template, $parameters);
    }
    
}