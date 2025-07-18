<?php
namespace Yash\US5\Controller\Index;

use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $resultRedirectFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       RedirectFactory $resultRedirectFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('catalog/product/view', ['id' => 10]);
        return $resultRedirect;
    }
}