<?php
namespace Yash\Task2\Block\Adminhtml\System\Config;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Config\Block\System\Config\Form\Field;

class Date extends Field
{
    protected function _getElementHtml(AbstractElement $element)
    {
        $element->setDateFormat('dd-MM-yyyy');
        $element->setTime(false);
        $element->setClass('datepicker');

        return $element->getElementHtml();
    }
}