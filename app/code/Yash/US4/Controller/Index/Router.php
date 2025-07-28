<?php
namespace Yash\US4\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http as HttpRequest;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    protected ActionFactory $actionFactory;

    public function __construct(
        ActionFactory $actionFactory
    ) {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request): ?ActionInterface
    {
        if (!$request instanceof HttpRequest) {
            return null;
        }

        $path = trim($request->getPathInfo(), '/');

        if (preg_match('#^([A-Z][a-z0-9]+)([A-Z][a-z0-9]+)([A-Z][a-z0-9]+)$#', $path, $matches)) {
            $module = strtolower($matches[1]);
            $controller = strtolower($matches[2]);
            $action = strtolower($matches[3]);

            $request->setModuleName($module);
            $request->setControllerName($controller);
            $request->setActionName($action);
            $request->setAlias(\Magento\Framework\UrlInterface::REWRITE_REQUEST_PATH_ALIAS, $path);

            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

        return null;
    }
}