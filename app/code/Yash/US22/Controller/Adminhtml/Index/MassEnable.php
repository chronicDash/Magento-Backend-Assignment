<?php
namespace Yash\US22\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Ui\Component\MassAction\Filter;
use Yash\US22\Model\Popup;
use Yash\US22\Model\ResourceModel\Popup\CollectionFactory;
use Yash\US22\Service\PopupRepository;

class MassEnable extends \Magento\Backend\App\Action
{
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       private readonly Filter $filter,
       private readonly CollectionFactory $collectionFactory,
       private readonly PopupRepository $popupRepository,
       private readonly RedirectFactory $redirectFactory
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
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $size = $collection->getSize();

        try {
            foreach($collection as $item) {
                $item->setIsActive(Popup::STATUS_ENABLED);
                $this->popupRepository->save($item);
            }
            $this->messageManager->addSuccessMessage(
                "A total of %1 record(s) have been enabled", $size
            );
        }
        catch(\Throwable $err) {
            $this->messageManager->addErrorMessage('Something went wrong!');
        }


        $result = $this->redirectFactory->create();
        return $result->setPath('us22/index/index');
    }
}