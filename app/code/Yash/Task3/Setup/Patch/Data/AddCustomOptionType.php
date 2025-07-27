<?php
namespace Yash\Task3\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCustomOptionType implements DataPatchInterface
{
    public function __construct() {}

    public function apply()
    {
        return $this;
    }

    public static function getDependencies() { return []; }

    public function getAliases() { return []; }
}
