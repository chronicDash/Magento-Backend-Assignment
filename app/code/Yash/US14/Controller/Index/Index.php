<?php
namespace Yash\US14\Controller\Index;

use Yash\US14\Model\InventoryMonitor;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $inventoryMonitor;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       InventoryMonitor $inventoryMonitor
    )
    {
        $this->inventoryMonitor = $inventoryMonitor;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $page = $this->_pageFactory->create();
        $this->inventoryMonitor->checkProductQuantity('24-MB01');
        return $page;
    }
}