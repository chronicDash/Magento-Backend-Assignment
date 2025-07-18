<?php
namespace Yash\US1\Controller\Index;

use \Yash\US1\Test;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $testClass;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       Test $testClass
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->testClass = $testClass;
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
        $page->getConfig()->getTitle()->set($this->testClass->displayParams());
        return $page;
    }
}