<?php
namespace Yash\US2\Plugin;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\Product;

class AddLogoPlugin
{

    public function afterGetProductDetailsHtml(ListProduct $subject, $result, Product $product) {

        $price = (float) $product->getFinalPrice();

        if($price < 60) {
            $logoHtml = '<div class="discount-logo" style="position:relative;top:-410px;left:5px;z-index:100;">
                <img src="' . $subject->getViewFileUrl('Yash_US2::images/sale-logo.png') . '" 
                     alt="Discount Logo" 
                     style="width:50px;height:auto;z-index: 100;" />
            </div>';

            return (string)$logoHtml . $result;
        }
        return $result;
    }
}