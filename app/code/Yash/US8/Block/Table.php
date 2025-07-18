<?php
namespace Yash\US8\Block;

use Magento\Framework\View\Element\Template;
use Yash\US8\Model\ResourceModel\Employee\CollectionFactory;

class Table extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getEmployees($sortField = 'employee_id', $sortDir = 'ASC')
    {
        $collection = $this->collectionFactory->create();
        $collection->setOrder($sortField, $sortDir);
        return $collection;
    }
}