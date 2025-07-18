<?php
namespace Yash\US22\Service;

use Yash\US22\Model\Popup;
use Yash\US22\Model\ResourceModel\Popup\CollectionFactory;

class PopupManagement
{
    public function __construct(
        private readonly CollectionFactory $collectionFactory
    )
    {   
    }

    public function getApplicablePopup() {
        return $this->getCollection()->addFieldToFilter('is_active', Popup::STATUS_ENABLED)
        ->addOrder('popup_id')->getFirstItem();
    }

    public function getCollection() {
        return $this->collectionFactory->create();
    }
}
