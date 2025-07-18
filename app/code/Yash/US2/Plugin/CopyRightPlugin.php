<?php
namespace Yash\US2\Plugin;

class CopyRightPlugin
{
    public function afterGetCopyright($subject, $result)
    {
        return '© 2025 Hummingbird Inc. All Rights Reserved.';
    }
}
