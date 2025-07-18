<?php
namespace Yash\US8\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Yash\US8\Model\Employee::class,
            \Yash\US8\Model\ResourceModel\Employee::class
        );
    }
}