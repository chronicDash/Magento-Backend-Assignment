<?php
namespace Yash\US7\Block;

class Message extends \Magento\Framework\View\Element\Template
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

    public function getMessage() {
        return "This is a message from block";
    }

    public function _afterToHtml($html) {
        return $html . "This is a message from afterToHtml";
    }
}