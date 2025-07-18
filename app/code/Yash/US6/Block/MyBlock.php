<?php
namespace Yash\US6\Block;

class MyBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function _toHtml() {
        return "This is a text from _toHtml";
    }

    protected function _afterToHtml($html) {
        return $html . "<br>This is a text from _afterToHtml";
    }
}