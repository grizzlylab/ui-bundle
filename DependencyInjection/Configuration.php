<?php

namespace Grizzlylab\Bundle\UIBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @author Jean-Louis Pirson <jl.pirson@grizzlylab.be>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('grizzlylab_ui');

        $treeBuilder
            ->getRootNode()
            ->children()
            ->arrayNode('alert')
                ->children()
                    ->scalarNode('template')->defaultValue('@GrizzlylabUI/alert.html.twig')->end()
                    ->scalarNode('translation_domain')->defaultValue('messages')->end()
                    ->arrayNode('translation_parameters')
                        ->prototype('scalar')->end()
                        ->defaultValue(
                            [
                                '%%strong_start%%' => '<strong>',
                                '%%strong_end%%'   => '</strong>',
                            ]
                        )
                    ->end()
                    ->booleanNode('translate')->defaultTrue()->end()
                    ->booleanNode('escape_message')->defaultTrue()->end()
                    ->booleanNode('escape_prefix')->defaultFalse()->end()
                    ->booleanNode('dismissible')->defaultFalse()->end()
                    ->scalarNode('dismiss_button')->defaultValue('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>')->end()
                    ->booleanNode('display_prefix')->defaultTrue()->end()
                    ->enumNode('context')->values(['info', 'success', 'warning', 'danger'])->defaultValue('info')->end()
                    ->arrayNode('prefixes')->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('info')->defaultValue('<span class="glyphicon glyphicon-info-sign"></span> ')->end()
                            ->scalarNode('success')->defaultValue('<span class="glyphicon glyphicon-ok"></span> ')->end()
                            ->scalarNode('warning')->defaultValue('<span class="glyphicon glyphicon-warning-sign"></span> ')->end()
                            ->scalarNode('danger')->defaultValue('<span class="glyphicon glyphicon-warning-sign"></span> ')->end()
                        ->end()// prefixes children
                    ->end()// prefixes
                ->end()// alert children
            ->end()// alert

            ->arrayNode('modal')
                ->children()
                    ->scalarNode('template')->defaultValue('@GrizzlylabUI/modal.html.twig')->end()
                    ->scalarNode('id')->defaultValue('modal')->end()
                    ->enumNode('backdrop')->values(['true', 'false', 'static'])->defaultValue('true')->end()
                    ->enumNode('keyboard')->values(['true', 'false'])->defaultValue('true')->end()
                    ->booleanNode('fade')->defaultTrue()->end()
                    ->enumNode('size')->values(['small', 'medium', 'large'])->defaultValue('medium')->end()
                    ->booleanNode('escape_title')->defaultTrue()->end()
                    ->booleanNode('escape_body')->defaultTrue()->end()
                    ->booleanNode('translate_title')->defaultTrue()->end()
                    ->booleanNode('translate_body')->defaultTrue()->end()
                    ->scalarNode('title_markup')->defaultValue('h1')->end()
                    ->scalarNode('title_translation_domain')->defaultValue('messages')->end()
                    ->arrayNode('title_translation_parameters')
                        ->prototype('scalar')->end()
                        ->defaultValue(
                            [
                                '%%strong_start%%' => '<strong>',
                                '%%strong_end%%'   => '</strong>',
                            ]
                        )
                    ->end()
                    ->scalarNode('body_translation_domain')->defaultValue('messages')->end()
                    ->arrayNode('body_translation_parameters')
                        ->prototype('scalar')->end()
                        ->defaultValue(
                            [
                                '%%strong_start%%' => '<strong>',
                                '%%strong_end%%'   => '</strong>',
                            ]
                        )
                    ->end()
                    ->scalarNode('dismiss_button')->defaultValue('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>')->end()
                    ->booleanNode('keep_default_footer_buttons')->defaultTrue()->end()
                    ->scalarNode('footer_raw_prepend')->defaultValue('')->end()
                    ->scalarNode('footer_raw_append')->defaultValue('')->end()
                    ->arrayNode('footer_buttons')
                        ->treatNullLike([])
                        ->prototype('array')->end()
                        ->defaultValue([0 => ['link' => false, 'escape' => true, 'translate' => true, 'dismiss' => true, 'context' => 'default', 'label' => 'grizzlylab_ui.modal.close']])
                        ->prototype('array')->end()
                    ->end()// footer_buttons
                ->end()// modal children
            ->end()// modal

            ->arrayNode('modal_trigger')
                ->children()
                    ->scalarNode('template')->defaultValue('@GrizzlylabUI/modal_trigger.html.twig')->end()
                    ->enumNode('context')->values(['info', 'success', 'warning', 'danger'])->defaultValue('info')->end()
                    ->booleanNode('escape')->defaultTrue()->end()
                    ->booleanNode('translate')->defaultTrue()->end()
                    ->scalarNode('translation_domain')->defaultValue('messages')->end()
                    ->arrayNode('translation_parameters')
                        ->prototype('scalar')->end()
                        ->defaultValue(
                            [
                                '%%strong_start%%' => '<strong>',
                                '%%strong_end%%'   => '</strong>',
                            ]
                        )
                    ->end()
                    ->enumNode('size')->values(['small', 'medium', 'large'])->defaultValue('medium')->end()
                    ->booleanNode('is_link')->defaultFalse()->end()
                ->end()// modal_trigger children
            ->end()// modal_trigger

            ->arrayNode('truncate_to_tooltip')
                ->children()
                    ->integerNode('length')->defaultValue(30)->end()
                    ->booleanNode('preserve')->defaultFalse()->end()
                    ->scalarNode('separator')->defaultValue('...')->end()
	                ->enumNode('tooltip_placement')->values(['top', 'right', 'bottom', 'left'])->defaultValue('top')->end()
                    ->scalarNode('template')->defaultValue('@GrizzlylabUI/truncate_to_tooltip.html.twig')->end()
                ->end()// truncate children
            ->end()// truncate

        ->end()// root children
        ->end();// root

        return $treeBuilder;
    }
}
