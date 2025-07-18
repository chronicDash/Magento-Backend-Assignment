<?php
namespace Yash\US24\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends Template
{
    protected $scopeConfig;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getJsConfig()
    {
        return [
            'sales_email' => $this->scopeConfig->getValue('sales_email/general/email'),
            'checkmo_enabled' => $this->scopeConfig->isSetFlag('payment/checkmo/active'),
        ];
    }
}