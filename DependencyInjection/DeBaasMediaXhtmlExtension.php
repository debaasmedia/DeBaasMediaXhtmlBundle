<?php

  namespace DeBaasMedia\Bundle\XhtmlBundle\DependencyInjection;

  use Symfony\Component\Config\FileLocator
    , Symfony\Component\Config\Definition\Processor
    , Symfony\Component\Config\Definition\Builder\TreeBuilder
    , Symfony\Component\DependencyInjection\Loader\XmlFileLoader
    , Symfony\Component\DependencyInjection\ContainerBuilder
    , Symfony\Component\HttpKernel\DependencyInjection\Extension;

  /**
   * DoctrineExtensionsSluggableBundle.
   *
   * @author  Marijn Huizendveld <marijn.huizendveld@gmail.com>
   */
  class DeBaasMediaXhtmlExtension extends Extension
  {

    /**
     * {@inheritDoc}
     */
    public function load (array $configs, ContainerBuilder $container)
    {
      $processor = new Processor();

      $config = $processor->process($this->generateConfigTree(new TreeBuilder), $configs);

      $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__ . '/../Resources/config')));

      $loader->load('xhtml.xml');

      $container->setParameter('response_listener.class', $config['response_listener_class']);
    }

    /**
     * Generates the configuration tree.
     *
     * @return Symfony\Component\Config\Definition\NodeInterface
     */
    public function generateConfigTree (TreeBuilder $arg_builder)
    {
      $arg_builder->root('doctrine_extensions_sluggable')
                    ->children()
                      ->scalarNode('response_listener_class')->defaultValue('DeBaasMedia\Bundle\XhtmlBundle\ResponseListener')->end()
                    ->end()
                  ->end();

      return $arg_builder->buildTree();
    }

  }