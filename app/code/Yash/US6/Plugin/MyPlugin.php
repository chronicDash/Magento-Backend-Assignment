<?php
namespace Yash\US6\Plugin;

use Magento\Catalog\Model\Product;

class MyPlugin
{
    public function afterGetData(Product $subject, $result, $key = '')
    {
        if ($key === 'description') {
            return "Sample Description (From Plugin)";
        }
        return $result;
    }

}
