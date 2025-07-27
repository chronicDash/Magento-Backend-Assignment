<?php
namespace Yash\Task1\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;

class ValidatePhoneNumber implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $phone = $customer->getCustomAttribute('phone_number')?->getValue();

        if ($phone && !preg_match('/^\+91-\d{10}$/', $phone)) {
            throw new LocalizedException(__('Phone number must be in the format +91-XXXXXXXXXX (e.g., +91-9876543210).'));
        }
    }
}