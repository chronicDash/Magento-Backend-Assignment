<?php
namespace Yash\US5\Plugin;

use Magento\Framework\View\Element\Template;

class MyPlugin
{
    public function afterToHtml(Template $subject, $result)
    {
        if($subject->getNameInLayout() === 'product.info') {
            $result .= '<div style="color: red;"> <strong>This is a custom text</strong></div>';
        }

        return $result;
    }

}
