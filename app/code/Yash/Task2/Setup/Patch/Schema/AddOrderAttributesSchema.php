<?php
namespace Yash\Task2\Setup\Patch\Schema;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Sales\Setup\SalesSetupFactory;

class AddOrderAttributesSchema implements SchemaPatchInterface
{
    private $moduleDataSetup;
    private $salesSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        SalesSetupFactory $salesSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->salesSetupFactory = $salesSetupFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $salesSetup = $this->salesSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attributes = [
            'expected_delivery_date' => ['type' => 'datetime'],
            'processing_status' => ['type' => 'text'],
            'custom_instructions' => ['type' => 'text'],
        ];

        foreach ($attributes as $code => $data) {
            $salesSetup->addAttribute('order', $code, [
                'type' => $data['type'],
                'visible' => false,
                'nullable' => true,
                'default' => null
            ]);
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies() { return []; }

    public function getAliases() { return []; }
}