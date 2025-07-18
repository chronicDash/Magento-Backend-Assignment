<?php
namespace Yash\US22\Service;

use Magento\Framework\Exception\NoSuchEntityException;
use Yash\US22\Model\ResourceModel\Popup;
use Yash\US22\Model\PopupFactory;

class PopupRepository
{
    public function __construct(
        private readonly Popup $resource,
        private readonly PopupFactory $factory
    )
    {
        
    }

    public function save($popup) {
        $this->resource->save($popup);
    }

    public function delete($popup) {
        $this->resource->delete($popup);
    }

    public function getById($popupId) {
        $popup = $this->factory->create();
        $this->resource->load($popup, $popupId);

        if(!$popup->getId()) {
            throw new NoSuchEntityException(__("The popup id with %1 does no exists"), $popupId);
        }
        return $popup;
    }
}
