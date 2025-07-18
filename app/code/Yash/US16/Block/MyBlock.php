<?php
namespace Yash\US16\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;

class MyBlock extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getColor() {
        return $this->scopeConfig->getValue(
            'mod16/design/color_picker',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
