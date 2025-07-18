<?php
namespace Yash\US14\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Yash\US14\Logger\Logger;

class SendLowInventoryEmail implements ObserverInterface
{
    protected $transportBuilder;
    protected $storeManager;
    protected $scopeConfig;
    protected $logger;

    public function __construct(
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        Logger $logger
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $sku = $observer->getData('sku');
        $qty = $observer->getData('qty');
        $product = $observer->getData('product');
        
        $this->logger->info(
            "SKU: $sku\n Qty: $qty\n The Product's inventory is below 5\n"
        );
    }
}