<?php
namespace Yash\US2\Plugin;

use Magento\Framework\Pricing\Render\PriceBox;

class PricePlugin
{
    public function afterRenderAmount(PriceBox $subject, $result)
    {
        $product = $subject->getSaleableItem();
        $price = $product->getFinalPrice();
        
        if($price < 20) {
            $result .= ' <span style="color:red; font-weight:bold;">WholeSale!!</span>';
        }
        else if($price > 20 && $price < 50) {
            $newPrice = $price - ($price * 0.15);
            $product->setFinalPrice($newPrice);
            $result .= ' <span style="color:red; font-weight:bold;">Super Sale!!</span>';
        }
        else if($price < 60) {
            $result .= ' <span style="color:red; font-weight:bold;">On Sale!</span>';
        }
        else if($price > 50) {
            $result .= ' <span style="color:red; font-weight:bold;">Premium!!</span>';
        }
        

        return $result;
    }
}
