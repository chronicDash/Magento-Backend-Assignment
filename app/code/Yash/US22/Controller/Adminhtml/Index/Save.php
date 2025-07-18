<?php
namespace Yash\US22\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Yash\US22\Service\PopupRepository;
use Yash\US22\Model\PopupFactory;

class Save extends Action implements HttpPostActionInterface
{
    public function __construct(
        Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly PopupFactory $popupFactory,
        private readonly PopupRepository $popupRepository
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = PopupFactory::STATUS_ENABLED;
            }
            if (empty($data['popup_id'])) {
                $data['popup_id'] = null;
            }


            $id = (int) $this->getRequest()->getParam('popup_id');
            if ($id) {
                try {
                    $popup = $this->popupRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            else {
                $popup = $this->popupFactory->create();
            }

            $popup->setData($data);

            try {
                $this->popupRepository->save($popup);
                $this->messageManager->addSuccessMessage(__('You saved the popup.'));
                $this->dataPersistor->clear('us22');
                return $resultRedirect->setPath('*/*/');
                
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the popup.'));
            }

            $this->dataPersistor->set('us22', $data);
            return $resultRedirect->setPath('*/*/edit', ['popup_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}