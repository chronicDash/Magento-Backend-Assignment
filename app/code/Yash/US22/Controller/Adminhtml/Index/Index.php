<?php
namespace Yash\US22\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Yash_US22::popup';
    private const PAGE_TITLE    = 'Popups';

    /** @var PageFactory */
    private PageFactory $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        // Always call the parent constructor first
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        // Create backend page
        $resultPage = $this->pageFactory->create();

        // Highlight your menu item (must match the ID in menu.xml)
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE);

        // Set page title
        $resultPage->getConfig()->getTitle()->prepend(self::PAGE_TITLE);

        return $resultPage;
    }

    /**
     * @inheritdoc
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
