<?php
namespace Yash\US18\Plugin;

class AdjustQuoteItemPrice
{
    public function afterGetBaseCalculationPrice(\Magento\Quote\Model\Quote\Item $subject, $result)
    {
        return $result + 1.79;
    }

    public function afterGetCalculationPrice(\Magento\Quote\Model\Quote\Item $subject, $result)
    {
        return $result + 1.79;
    }

    public function afterGetPrice(\Magento\Quote\Model\Quote\Item $subject, $result)
    {
        return $result + 1.79;
    }
}
