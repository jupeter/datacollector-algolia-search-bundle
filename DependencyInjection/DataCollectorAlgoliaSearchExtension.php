<?php
/**
 * Created by IntelliJ IDEA.
 * User: jupeter
 * Date: 29.03.17
 * Time: 14:52
 */

namespace Jupeter\DataCollectorAlgoliaSearchBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

class DataCollectorAlgoliaSearchExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['disable_requests'])) {
            $container->setParameter('algolia_data_collector.disable_requests', $config['disable_requests']);
        }
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

    }
    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'algolia_data_collector';
    }
}