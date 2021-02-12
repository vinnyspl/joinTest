<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Produto;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\ModuleManager\Feature\ConfigProviderInterface; 

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
     public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\ProdutoTable::class => function ($container) {
                    $tableGateway = $container->get(Model\ProdutoTableGateway::class);
                    return new Model\ProdutoTable($tableGateway);
                },
                Model\ProdutoTableGateway::class => function ($container) {
                    $adapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Produto);
                    return new TableGateway('produto', $adapter, null, $resultSetPrototype);
                },
                Model\CategoriaTable::class => function ($container) {
                    $tableGateway = $container->get(Model\CategoriaTableGateway::class);
                    return new Model\CategoriaTable($tableGateway);
                },
                Model\CategoriaTableGateway::class => function ($container) {
                    $adapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Categoria);
                    return new TableGateway('categoria', $adapter, null, $resultSetPrototype);
                }
            ]

        ];
    }

    public function getControllerConfig()
    {
          return [
              'factories' => [
                  Controller\IndexController::class => function ($container) {

                      return new Controller\IndexController(
                          $container->get(Model\ProdutoTable::class),
                          $container->get(\Categoria\Model\CategoriaTable::class)
                      );

                  }
              ]
          ];
    }
}
