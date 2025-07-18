<?php
namespace Yash\US22\Controller\Adminhtml\Index;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Yash\US22\Service\PopupRepository;

class Edit extends \Magento\Backend\App\Action
{
    const PAGE_TITLE = 'Popup Form';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       private readonly PopupRepository $popupRepository,
       private readonly DataPersistorInterface $dataPersistor
    )
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $popupId = $this->getRequest()->getParam('popup_id');
        $resultPage = $this->_pageFactory->create();
        
        try {
            $popup = $this->popupRepository->getById($popupId);
            $this->dataPersistor->set('us22', $popup->getData());
            $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
            $resultPage->addBreadcrumb(
                $popup->getPopupID() ? $popup->getName() : __(static::PAGE_TITLE), 
                $popup->getPopupID() ? $popup->getName() : __(static::PAGE_TITLE)
            );
            $resultPage->getConfig()->getTitle()->prepend($popup->getPopupID() ? $popup->getName() : __(static::PAGE_TITLE));
        }
        catch(NoSuchEntityException $err) {
            $this->messageManager->addErrorMessage('No such id exits');
        }
        
        

        return $resultPage;
    }
}
