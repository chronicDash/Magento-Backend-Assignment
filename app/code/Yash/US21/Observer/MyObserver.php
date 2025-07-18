<?php
namespace Yash\US21\Observer;

use Magento\Framework\App\RequestInterface;

class MyObserver implements \Magento\Framework\Event\ObserverInterface
{
    protected $req;
    public function __construct(
        RequestInterface $req
    )
    {
        $this->req = $req;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->req->getParam('affiliate') === 'true') {
            $layout = $observer->getLayout();
            $layout->unsetElement('product.info.review');
        }
    }
}