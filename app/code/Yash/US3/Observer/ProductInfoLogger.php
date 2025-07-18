<?php
namespace Yash\US3\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Yash\US3\Logger\Logger;
use Magento\Framework\Registry;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;
use Magento\InventoryApi\Api\GetSourceItemsBySkuInterface;

class ProductInfoLogger implements ObserverInterface
{
    protected $logger;
    protected $salableQty;
    protected $sourceItems;

    public function __construct(
        Logger $logger,
        GetProductSalableQtyInterface $salableQty,
        GetSourceItemsBySkuInterface $sourceItems,
    ) {
        $this->logger = $logger;
        $this->salableQty = $salableQty;
        $this->sourceItems = $sourceItems;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();

        if(!$product) return;

        $sku = $product->getSku();
        $name = $product->getName();
        $price = $product->getFinalPrice();

        $this->logger->info("SKU: " . $sku);
        $this->logger->info("Name: " . $name);
        $this->logger->info("Price: " . $price);
        

        try {
            $salableQnty = $this->salableQty->execute($sku, 1);
            $this->logger->info("Salable Quantity: " . $salableQnty);
        }
        catch (\Exception $e) {
            $this->logger->info($e);
        }
        $srcItems = $this->sourceItems->execute($sku);
        foreach($srcItems as $item) {
            $this->logger->info(sprintf(
                "Source: %s | Qty: %s | Status: %s",
                $item->getSourceCode(),
                $item->getQuantity(),
                $item->getStatus()
            ));
        }
    }
}