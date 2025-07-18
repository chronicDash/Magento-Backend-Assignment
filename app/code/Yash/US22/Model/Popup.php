<?php
namespace Yash\US22\Model;


class Popup extends \Magento\Framework\Model\AbstractModel
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

    public function _construct() {
        $this->_eventPrefix = 'yash_us22';
        $this->_eventObject = 'popup';
        $this->_idFieldName = 'popup_id';
        $this->_init(\Yash\US22\Model\ResourceModel\Popup::class);
    }

    public function getPopupId() {
        return (int) $this->getData('popup_id');
    }

    public function setPopupId(int $popupId) {
        return $this->setData('popup_id', $popupId);
    }

    public function getContent() {
        return $this->getData('content');
    }
    public function setContent($content) {
        $this->setData('content', $content);
    }
    public function getCreatedAt() {
        return (string) $this->getData('created_at');
    }
    public function setCreatedAt(string $time) {
        $this->setData('created_at', $time);
    }
    public function getUpdatedAt() {
        return (string) $this->getData('updated_at');
    }
    public function setUpdatedAt(string $time) {
        $this->setData('updated_at', $time);
    }

    public function getIsActive() {
        return (bool) $this->getData('is_active');
    }

    public function setIsActive(bool $isActive) {
        $this->setData('is_active', $isActive);
    }

    public function getTimeout() {
        return (int) $this->getData('timeout');
    }

    public function setTimeout(int $timeout) {
        $this->setData('timeout', $timeout);
    }
}
