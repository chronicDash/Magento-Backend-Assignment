<?php
namespace Yash\US2\Plugin;

use Magento\Catalog\Model\Product;

class ProductNamePlugin
{
    public function afterGetName(Product $subject, $result)
    {
        $price = $subject->getFinalPrice();

        if ($price < 20) {
            $result .= ' WholeSale !!';
        } elseif ($price >= 20 && $price < 50) {
            $discountedPrice = $price * 0.85;
            $result .= ' Super Sale!! (Now: $' . number_format($discountedPrice, 2) . ')';
        } elseif ($price >= 50) {
            $result .= ' Premium !!';
        }

        return $result;
    }
}