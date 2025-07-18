<?php
namespace Yash\US14\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;

class InventoryMonitor
{
    protected $productRepository;
    protected $eventManager;


    public function __construct(
        ProductRepositoryInterface $productRepository,
        EventManager $eventManager
    ) {
        $this->productRepository = $productRepository;
        $this->eventManager = $eventManager;
    }

    public function checkProductQuantity($sku)
    {
        $product = $this->productRepository->get($sku);
        $qty = $product->getExtensionAttributes()->getStockItem()->getQty();

        if ($qty <= 500) {
            $this->eventManager->dispatch('vendor_low_inventory_alert', [
                'sku' => $sku,
                'qty' => $qty,
                'product' => $product
            ]);
        }
    }
}