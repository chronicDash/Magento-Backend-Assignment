<?php
namespace Yash\US9\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class MyView implements ArgumentInterface
{
    protected $scopeConfig;
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getDisplayTextConfig() {
        return $this->scopeConfig->getValue(
            'general/general_config/display_text',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
