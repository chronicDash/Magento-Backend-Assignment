<?php
namespace Yash\US22\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Yash\US22\Service\PopupManagement;

class PopupViewModel implements ArgumentInterface
{
    public function __construct(
        private readonly PopupManagement $popupManagement
    )
    {
    }

    public function getPopup() {
        $popup = $this->popupManagement->getApplicablePopup();
        return $popup ? $popup : 'No Popup';
    }
}
