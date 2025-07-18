<?php
namespace Yash\US16\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class ColorOptions implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'red', 'label' => __('Red')],
            ['value' => 'green', 'label' => __('Green')],
            ['value' => 'orange', 'label' => __('Orange')],
        ];
    }
}