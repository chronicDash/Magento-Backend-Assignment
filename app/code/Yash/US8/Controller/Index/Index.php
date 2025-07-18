<?php
namespace Yash\US8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Yash\US8\Model\EmployeeFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request\Http;

class Index extends Action
{
    protected $employeeFactory;
    protected $pageFactory;
    protected $request;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory,
        PageFactory $pageFactory,
        Http $request
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->pageFactory = $pageFactory;
        $this->request = $request;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->request->isPost()) {
            $data = $this->getRequest()->getPostValue();

            if ($this->validate($data)) {
                $model = $this->employeeFactory->create();
                $employeeId = 'EMP' . (rand(1, 9999)); // Example, ideally you'd calculate max + 1

                $model->setData([
                    'employee_id' => $employeeId,
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email_id' => $data['email_id'],
                    'address' => $data['address'],
                    'phone_number' => $data['phone_number'],
                ]);
                $model->save();
            }
        }

        return $this->pageFactory->create();
    }

    protected function validate($data)
    {
        return preg_match('/^[a-zA-Z]{1,30}$/', $data['first_name']) &&
               preg_match('/^[a-zA-Z]{1,30}$/', $data['last_name']) &&
               filter_var($data['email_id'], FILTER_VALIDATE_EMAIL) &&
               strlen($data['address']) > 30 &&
               preg_match('/^[0-9]{10}$/', $data['phone_number']);
    }
}