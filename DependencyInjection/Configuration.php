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
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('grizzlylab_ui', 'array');
        $rootNode
            ->children()
            ->arrayNode('alert')
            ->children()
            ->scalarNode('translation_domain')->defaultValue('messages')->end()
            ->arrayNode('translation_parameters')
                ->prototype('scalar')->end()
            ->end()
            ->booleanNode('translate')->defaultTrue()->end()
            ->booleanNode('escape_message')->defaultTrue()->end()
            ->booleanNode('escape_prefix')->defaultFalse()->end()
            ->scalarNode('context')->defaultValue('info')->end()
            ->booleanNode('dismissible')->defaultFalse()->end()
            ->scalarNode('dismissible_button')->defaultValue('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>')->end()
            ->booleanNode('display_prefix')->defaultTrue()->end()
            ->scalarNode('template')->defaultValue('GrizzlylabUIBundle::alert.html.twig')->end()
            ->enumNode('context')->values(array('info', 'success', 'warning', 'danger'))->defaultValue('info')->end()
            ->arrayNode('prefixes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('info')->defaultValue('<span class="glyphicon glyphicon-info-sign"></span> ')->end()
                        ->scalarNode('success')->defaultValue('<span class="glyphicon glyphicon-ok"></span> ')->end()
                        ->scalarNode('warning')->defaultValue('<span class="glyphicon glyphicon-warning-sign"></span> ')->end()
                        ->scalarNode('danger')->defaultValue('<span class="glyphicon glyphicon-warning-sign"></span> ')->end()
                    ->end()
                ->end()
            ->end()
            ->end()// alert
            ->end();

        return $treeBuilder;
    }
}
