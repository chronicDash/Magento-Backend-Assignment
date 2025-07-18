<?php
namespace Yash\US18\Plugin;

class changePricePlugin
{
    public function afterGetFinalPrice(\Magento\Catalog\Model\Product $subject, $result) {
        return $result + 1.79;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result) {
        return $result + 1.79;
    }
}