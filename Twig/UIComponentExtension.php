<?php

namespace Grizzlylab\Bundle\UIBundle\Twig;

/**
 * Class UIComponentExtension
 * @package MYQMP\Bundle\CoreBundle\Twig
 * @author  Jean-Louis Pirson <jl.pirson@grizzlylab.be>
 */
class UIComponentExtension extends \Twig_Extension
{

    private $uiConfig = array();

    /**
     * Constructor
     *
     * @param array $uiConfig
     */
    public function __construct($uiConfig)
    {
        $this->uiConfig = $uiConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'alert',
                [$this, 'alertFunction'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            ),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'alert',
                [$this, 'alertFunction'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            ),
        ];
    }

    /**
     * @param \Twig_Environment $environment
     * @param string            $message
     * @param array             $options
     *
     * @return string
     */
    public function alertFunction(\Twig_Environment $environment, $message, array $options = [])
    {
        $config = $this->uiConfig['alert'];
        $context = isset($options['context']) ? $options['context'] : $config['context'];

        return $environment->render(
            isset($options['template']) ? $options['template'] : $config['template'],
            [
                'translation_domain' => isset($options['translation_domain']) ? $options['translation_domain'] : $config['translation_domain'],
                'translation_parameters' => isset($options['translation_parameters']) ? $options['translation_parameters'] : $config['translation_parameters'],
                'translate' => isset($options['translate']) ? $options['translate'] : $config['translate'],
                'message' => $message,
                'escape_message' => isset($options['escape_message']) ? $options['escape_message'] : $config['escape_message'],
                'escape_prefix' => isset($options['escape_prefix']) ? $options['escape_prefix'] : $config['escape_prefix'],
                'context' => $context,
                'dismissible' => isset($options['dismissible']) ? $options['dismissible'] : $config['dismissible'],
                'display_prefix' => isset($options['display_prefix']) ? $options['display_prefix'] : $config['display_prefix'],
                'prefix' => isset($options['prefix']) ? $options['prefix'] : $config['prefixes'][$context],
                'attr' => isset($options['attr']) ? $options['attr'] : null,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'grizzlylab_ui_alert_extension';
    }
}
