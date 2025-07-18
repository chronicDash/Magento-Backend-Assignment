<?php
namespace Yash\US22\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Yash\US22\Service\PopupRepository;

class Delete extends \Magento\Backend\App\Action
{
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       private readonly PopupRepository $popupRepository
    )
    {
        return parent::__construct($context);
    }

    public function execute()
    {
        $popupId = $this->getRequest()->getParam('popup_id');
        if(!$popupId) {
            throw new NoSuchEntityException(__('There is no popup with the id %1'), $popupId);
        }

        $popup = $this->popupRepository->getById($popupId);
        $this->popupRepository->delete($popup);
        $redirect = $this->resultRedirectFactory->create();
        return $redirect->setPath('*/*/');
    }
}
