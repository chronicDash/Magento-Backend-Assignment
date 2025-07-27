<?php
namespace Yash\US4\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Yash\US4\Logger\Logger;

class Router implements RouterInterface
{
    protected $actionFactory;

    public function __construct(
        ActionFactory $actionFactory,
        private readonly Logger $logger)
    {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {
        $path = trim($request->getPathInfo(), '/');

        if (preg_match('#^([A-Z][a-z0-9]+)([A-Z][a-z0-9]+)([A-Z][a-z0-9]+)$#', $path, $matches)) {
            $module = strtolower($matches[1]);
            $controller = strtolower($matches[2]);
            $action = strtolower($matches[3]);

            $request->setModuleName($module);
            $request->setControllerName($controller);
            $request->setActionName($action);
            $request->setAlias(\Magento\Framework\UrlInterface::REWRITE_REQUEST_PATH_ALIAS, $path);

            return $this->actionFactory->create('Magento\Framework\App\Action\Redirect');
        }

        return null;
    }
}