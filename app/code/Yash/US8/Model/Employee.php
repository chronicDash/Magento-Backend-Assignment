<?php
namespace Yash\US8\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Yash\US8\Model\ResourceModel\Employee::class);
    }
}