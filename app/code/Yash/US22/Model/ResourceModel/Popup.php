<?php
namespace Yash\US22\Model\ResourceModel;

class Popup extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('my_popup_table', 'popup_id');
    }
}
