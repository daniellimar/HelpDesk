<?php
namespace Tickets;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Tickets\Model\TicketsTable;
use Tickets\Controller\TicketsController;

class Module implements ConfigProviderInterface {

	public function getConfig() {
		return include __DIR__ . '/../config/module.config.php';
	}

	public function getServiceConfig() {
		return [
			'factories' => [
				Model\TicketsTable::class => function($container) {
					$tableGateway = $container->get(Model\TicketsTableGateway::class);
					return new TicketsTable($tableGateway);
				},
				Model\TicketsTableGateway::class => function($container) {
					$dbAdapter = $container->get(AdapterInterface::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Model\Tickets());
					return new TableGateway('tickets', $dbAdapter, null, $resultSetPrototype);
				},
			],
		];
	}
	public function getControllerConfig() {
		return [
			'factories' => [
				TicketsController::class => function($container) {
					$tableGateway = $container->get(Model\TicketsTable::class);
					return new TicketsController($tableGateway);
				}
			]
		];
	}
}
?>