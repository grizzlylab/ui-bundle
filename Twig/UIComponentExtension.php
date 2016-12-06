<?php

namespace Grizzlylab\Bundle\UIBundle\Twig;

/**
 * Class UIComponentExtension
 *
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
        $r = [];

        if (isset($this->uiConfig['alert'])) {
            $r[] = new \Twig_SimpleFunction(
                'alert',
                [$this, 'alert'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            );
        }
        if (isset($this->uiConfig['modal'])) {
            $r[] = new \Twig_SimpleFunction(
                'modal',
                [$this, 'modal'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            );
        }
        if (isset($this->uiConfig['modal_trigger'])) {
            $r[] = new \Twig_SimpleFunction(
                'modal_trigger',
                [$this, 'modalTrigger'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            );
        }

        return $r;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        $r = [];

        if (isset($this->uiConfig['alert'])) {
            $r[] = new \Twig_SimpleFilter(
                'alert',
                [$this, 'alert'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            );
        }
        if (isset($this->uiConfig['modal'])) {
            $r[] = new \Twig_SimpleFilter(
                'modal',
                [$this, 'modal'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            );
        }
        if (isset($this->uiConfig['modal_trigger'])) {
            $r[] = new \Twig_SimpleFilter(
                'modal_trigger',
                [$this, 'modalTrigger'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            );
        }
        if (isset($this->uiConfig['truncate_to_tooltip'])) {
            $r[] = new \Twig_SimpleFilter(
                'truncate_to_tooltip',
                [$this, 'truncate_to_tooltip'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true
                ]
            );
        }

        return $r;
    }

    /**
     * @param \Twig_Environment $environment
     * @param string            $message
     * @param array             $options
     *
     * @return string
     */
    public function alert(\Twig_Environment $environment, $message, array $options = [])
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
                'dismiss_button' => isset($options['dismiss_button']) ? $options['dismiss_button'] : $config['dismiss_button'],
                'display_prefix' => isset($options['display_prefix']) ? $options['display_prefix'] : $config['display_prefix'],
                'prefix' => isset($options['prefix']) ? $options['prefix'] : $config['prefixes'][$context],
                'attr' => isset($options['attr']) ? $options['attr'] : null,
            ]
        );
    }

    /**
     * Modal Trigger
     *
     * @param \Twig_Environment $environment
     * @param string            $label
     * @param array             $options
     *
     * @return string
     */
    public function modalTrigger(\Twig_Environment $environment, $label, array $options = [])
    {
        $config = $this->uiConfig['modal_trigger'];

        return $environment->render(
            isset($options['template']) ? $options['template'] : $config['template'],
            [
                'translation_domain' => isset($options['translation_domain']) ? $options['translation_domain'] : $config['translation_domain'],
                'translation_parameters' => isset($options['translation_parameters']) ? $options['translation_parameters'] : $config['translation_parameters'],
                'translate' => isset($options['translate']) ? $options['translate'] : $config['translate'],
                'label' => $label,
                'target' => isset($options['target']) ? $options['target'] : $this->uiConfig['modal']['id'],
                'context' => isset($options['context']) ? $options['context'] : $config['context'],
                'prefix' => isset($options['prefix']) ? $options['prefix'] : null,
                'escape' => isset($options['escape']) ? $options['escape'] : $config['escape'],
                'size' => isset($options['size']) ? $options['size'] : $config['size'],
                'attr' => isset($options['attr']) ? $options['attr'] : null,
                'is_link' => isset($options['is_link']) ? $options['is_link'] : $config['is_link'],
            ]
        );
    }

    /**
     * Modal
     *
     * @param \Twig_Environment $environment
     * @param string            $body
     * @param array             $options
     *
     * @return string
     */
    public function modal(\Twig_Environment $environment, $body, array $options = [])
    {
        $config = $this->uiConfig['modal'];

        $footerButtons = isset($options['footer_buttons']) ? $options['footer_buttons'] : $config['footer_buttons'];

        $keepDefaultFooterButtons = isset($options['keep_default_footer_buttons']) ? $options['keep_default_footer_buttons'] : $config['keep_default_footer_buttons'];

        if ($keepDefaultFooterButtons['keep_default_footer_buttons'] && isset($options['footer_buttons'])) {
            $footerButtons = array_merge($config['footer_buttons'], $footerButtons);
        }

        //define some default values for footer_buttons (not defined in Configuration.php)
        $i = 0;
        foreach ($footerButtons as $footerButton) {
            if (!isset($footerButton['escape'])) {
                $footerButton['escape'] = true;
            }
            if (!isset($footerButton['translate'])) {
                $footerButton['translate'] = true;
            }
            if (!isset($footerButton['context'])) {
                $footerButton['context'] = 'info';
            }
            if (!isset($footerButton['translation_parameters'])) {
                $footerButton['translation_parameters'] = [];
            }
            if (!isset($footerButton['translation_domain'])) {
                $footerButton['translation_domain'] = 'messages';
            }
            if (!isset($footerButton['translate'])) {
                $footerButton['translate'] = true;
            }
            if (!isset($footerButton['dismiss'])) {
                $footerButton['dismiss'] = false;
            }
            $footerButtons[$i] = $footerButton;
            $i++;
        }

        return $environment->render(
            isset($options['template']) ? $options['template'] : $config['template'],
            [
                'id' => isset($options['id']) ? $options['id'] : $config['id'],
                'backdrop' => isset($options['backdrop']) ? $options['backdrop'] : $this->uiConfig['modal']['backdrop'],
                'keyboard' => isset($options['keyboard']) ? $options['keyboard'] : $this->uiConfig['modal']['keyboard'],
                'attr' => isset($options['attr']) ? $options['attr'] : null,
                'fade' => isset($options['fade']) ? $options['fade'] : $config['fade'],
                'size' => isset($options['size']) ? $options['size'] : $config['size'],
                'title' => isset($options['title']) ? $options['title'] : null,

                'escape_title' => isset($options['escape_title']) ? $options['escape_title'] : $config['escape_title'],
                'escape_body' => isset($options['escape_body']) ? $options['escape_body'] : $config['escape_body'],

                'translate_title' => isset($options['translate_title']) ? $options['translate_title'] : $config['translate_title'],
                'translate_body' => isset($options['translate_body']) ? $options['translate_body'] : $config['translate_body'],

                'title_markup' => isset($options['title_markup']) ? $options['title_markup'] : $config['title_markup'],
                'title_translation_domain' => isset($options['title_translation_domain']) ? $options['title_translation_domain'] : $config['title_translation_domain'],
                'title_translation_parameters' => isset($options['title_translation_parameters']) ? $options['title_translation_parameters'] : $config['title_translation_parameters'],

                'body' => $body,
                'body_translation_domain' => isset($options['body_translation_domain']) ? $options['body_translation_domain'] : $config['body_translation_domain'],
                'body_translation_parameters' => isset($options['body_translation_parameters']) ? $options['body_translation_parameters'] : $config['body_translation_parameters'],

                'footer_raw_prepend' => isset($options['footer_raw_prepend']) ? $options['footer_raw_prepend'] : $config['footer_raw_prepend'],
                'footer_raw_append' => isset($options['footer_raw_append']) ? $options['footer_raw_append'] : $config['footer_raw_append'],
                'footer_buttons' => $footerButtons,

                'dismiss_button' => isset($options['dismiss_button']) ? $options['dismiss_button'] : $config['dismiss_button'],
            ]
        );
    }

    /**
     * truncate_to_tooltip
     *
     * @param \Twig_Environment $env
     * @param                   $value
     * @param int|null          $length
     * @param bool|null         $preserve
     * @param string|null       $separator
     *
     * @return mixed
     */
    public function truncate_to_tooltip(\Twig_Environment $env, $value, $length = 30, $preserve = false, $separator = '...')
    {
        $config = $this->uiConfig['truncate_to_tooltip'];

        return $env->render(
            isset($options['template']) ? $options['template'] : $config['template'],
            [
                'value' => $value,
                'length' => $length,
                'preserve' => $preserve,
                'separator' => $separator,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'grizzlylab_ui_extension';
    }
}
