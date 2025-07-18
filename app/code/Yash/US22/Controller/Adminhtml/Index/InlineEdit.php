<?php
namespace Yash\US22\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Ui\Component\MassAction\Filter;
use Yash\US22\Service\PopupRepository;

class InlineEdit extends \Magento\Backend\App\Action
{
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       private readonly Filter $filter,
       private readonly PopupRepository $popupRepository,
       private readonly JsonFactory $jsonFactory
    )
    {
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $items = $this->getRequest()->getParam('items');
        $messages = [];
        $error = false;

        if(!count($items)) {
            $messages[] = 'Please correct the data sent.';
            $error = true;
        }
        else {
            foreach(array_keys($items) as $popupId) {
                try {
                    $popup = $this->popupRepository->getById((int) $popupId);
                    $popup->setData(array_merge($popup->getData(), $items[$popupId]));
                    $this->popupRepository->save($popup);
                }
                catch(\Throwable $err) {
                    $messages[] = '[POPUP_ID: ' . $popupId . ']' . $err->getMessage();
                    $error = true;
                }
            }
        }

        


        $result = $this->jsonFactory->create();
        return $result->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}