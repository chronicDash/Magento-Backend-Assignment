<?php
namespace Yash\US3\Observer;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Registry;
use Yash\US3\Logger\Logger;

class MyObserver implements \Magento\Framework\Event\ObserverInterface
{
    protected $logger;
    protected $registry;
    public function __construct(
        Logger $logger,
        Registry $registry
    )
    {
        $this->registry = $registry;
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $this->registry->registry('current_product');
        if ($product) {
            $this->logger->info('Product Name: ' . $product->getName());
        }
        else {
            $this->logger->info('No product found');
        }
    }

}