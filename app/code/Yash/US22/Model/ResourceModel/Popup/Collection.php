<?php
namespace Yash\US22\Model\ResourceModel\Popup;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Yash\US22\Model\Popup', 'Yash\US22\Model\ResourceModel\Popup');
    }
}
