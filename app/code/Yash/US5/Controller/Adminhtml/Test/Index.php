<?php
namespace Yash\US5\Controller\Adminhtml\Test;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public function execute()
    {
        $access = $this->getRequest()->getParam('access');
        if ($access !== 'True') {
            return $this->resultRedirectFactory->create()->setPath('admin/dashboard/index');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Admin Page'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}