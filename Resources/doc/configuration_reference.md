QualityPressStaticContentBundle Configuration Reference
=======================================================

All available configuration options are listed below with their default values.

``` yaml
# app/config/config.yml
quality_press_static_content:
    manager: site    
    classes:
        content_manager : "QualityPress\Bundle\StaticContentBundle\Manager\ContentManager"
        context_manager : "QualityPress\Bundle\StaticContentBundle\Manager\ContextManager"
        
        context         : "QualityPress\Bundle\StaticContentBundle\Model\Context"
        content         : "QualityPress\Bundle\StaticContentBundle\Entity\Content"
    
    contexts:
        destaque_home:
            default_description : ~
            translation_domain  : ~
            content_view        : ''
    
    contents:
        recursos_especiais:
            description : 'Destaque entitulado "recursos especiais" exibido na home'
            context     : destaque_home
```