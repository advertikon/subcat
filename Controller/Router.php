<?php
namespace Advertikon\Subcat\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    private $routeConfig;
    private $actionFactory;
    private $actionList;

    public function __construct(
        \Magento\Framework\App\Route\ConfigInterface $routeConfig,
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\Router\ActionList $actionList
    ) {
       $this->routeConfig = $routeConfig;
       $this->actionFactory = $actionFactory;
       $this->actionList = $actionList;
    }
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        if ( !$this->checkUrl( $request->getPathInfo() ) ) {
            return null;
        }

        $modules = $this->routeConfig->getModulesByFrontName('test' );

        if (empty($modules)) {
            return null;
        }

        $actionClassName = $this->actionList->get( $modules[0], null, 'index', 'index');
        $actionInstance = $this->actionFactory->create($actionClassName);
        return $actionInstance;
    }

    private function checkUrl( string $url ) {
        var_dump( $url );
        return false;
    }
}