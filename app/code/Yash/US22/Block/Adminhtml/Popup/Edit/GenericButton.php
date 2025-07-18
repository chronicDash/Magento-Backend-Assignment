<?php
namespace Yash\US22\Block\Adminhtml\Popup\Edit;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
class GenericButton
{
    public function __construct(
        private readonly UrlInterface $url,
        private readonly RequestInterface $req
    ) {
    }

    public function getPopupId()
    {
        return (int) $this->req->getParam('popup_id', 0);
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->url->getUrl($route, $params);
    }
}
