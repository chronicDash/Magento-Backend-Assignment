<?php
namespace Yash\US3\Observer;

use Yash\US3\Logger\Logger;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class PageLoadObserver implements ObserverInterface
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $response = $observer->getEvent()->getData('response');
        $html = $response->getBody();
        $this->logger->info('HTML Snippet: ' . $html);
    }

}