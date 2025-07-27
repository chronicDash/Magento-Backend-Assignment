<?php
namespace Yash\Task2\Block\Checkout;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\OrderFactory;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Store\Model\ScopeInterface;

class SuccessOrderAttributes extends Template
{
    protected $checkoutSession;
    protected $orderFactory;

    public function __construct(
        Template\Context $context,
        CheckoutSession $checkoutSession,
        OrderFactory $orderFactory,
        private readonly ScopeConfigInterface $scopeConfigInterface,
        array $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;
        parent::__construct($context, $data);
    }

    public function getOrder()
    {
        $lastOrderId = $this->checkoutSession->getLastOrderId();
        if ($lastOrderId) {
            $order = $this->orderFactory->create()->load($lastOrderId);
            $order->setData([
                'expected_delivery_date' => $this->scopeConfigInterface->getValue(
                    'order_success/details/delivery_date',
                    ScopeInterface::SCOPE_STORE
                ),
                'processing_status' => $this->scopeConfigInterface->getValue(
                    'order_success/details/status',
                    ScopeInterface::SCOPE_STORE
                ),
                'custom_instructions' => $this->scopeConfigInterface->getValue(
                    'order_success/details/instructions',
                    ScopeInterface::SCOPE_STORE
                )
            ]);

            return $order;
        }
        return null;
    }
}