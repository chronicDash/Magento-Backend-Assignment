<?php
namespace Yash\Task1\Setup\Patch\Data;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Model\Customer;

class AddPhoneNumberAttribute implements DataPatchInterface
{
    private $moduleDataSetup;
    private $customerSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'phone_number',
            [
                'label' => 'Phone Number',
                'type' => 'varchar',
                'input' => 'text',
                'required' => true,
                'visible' => true,
                'user_defined' => true,
                'position' => 1000,
                'system' => 0,
                'validate_rules' => '[]'
            ]
        );

        $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'phone_number');
        $attribute->setData(
            'used_in_forms',
            ['customer_account_create', 'customer_account_edit', 'adminhtml_customer']
        );
        $attribute->save();

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies() {
        return [];
    }

    public function getAliases() {
        return [];
    }
}