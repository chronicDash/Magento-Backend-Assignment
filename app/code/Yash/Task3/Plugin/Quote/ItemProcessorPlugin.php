<?php
namespace Yash\Task3\Plugin\Quote;

use Magento\Quote\Model\Quote\Item;

class ItemProcessorPlugin
{
    public function afterAddOption(Item $subject, $result)
    {
        $option = $result->getOptionByCode('info_buyRequest');
        if ($option) {
            $buyRequest = json_decode($option->getValue(), true);
            if (!empty($buyRequest['options'])) {
                foreach ($buyRequest['options'] as $optionId => $value) {
                    if (strlen($value) > 200) {
                        $buyRequest['options'][$optionId] = substr($value, 0, 200);
                        $option->setValue(json_encode($buyRequest));
                    }
                }
            }
        }
        return $result;
    }
}

