<?php
namespace Yash\US4\Observer;

use Magento\Framework\App\RouterList;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Yash\US4\Logger\Logger;

class LogRouters implements ObserverInterface
{
    protected $logger;
    protected $routerList;

    public function __construct(Logger $logger, RouterList $routerList)
    {
        $this->logger = $logger;
        $this->routerList = $routerList;
    }

    public function execute(Observer $observer)
    {
        $routerNames = [];
        foreach ($this->routerList as $router) {
            $routerNames[] = get_class($router);
        }

        $this->logger->info('Registered Routers: ' . implode(', ', $routerNames));
    }
}