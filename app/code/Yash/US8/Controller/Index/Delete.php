<?php
namespace Yash\US8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Yash\US8\Model\EmployeeFactory;

class Delete extends Action
{
    protected $employeeFactory;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory
    ) {
        $this->employeeFactory = $employeeFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('employee_id');
        if ($id) {
            $employee = $this->employeeFactory->create()->load($id);
            if ($employee->getId()) {
                $employee->delete();
            }
        }
        return $this->_redirect('employee/index/index');
    }
}