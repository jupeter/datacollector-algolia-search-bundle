<?php


namespace Jupeter\DataCollectorAlgoliaSearchBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('algolia_data_collector');
        $rootNode
            ->children()
                ->booleanNode('disable_requests')->defaultFalse()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}