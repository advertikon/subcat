<?php


namespace Advertikon\Subcat\Model\Plugin;


use Magento\Framework\UrlInterface;

class UrlRewrite
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

    public function afterMatch( $subject, $result ) {
        /** @var \Magento\Framework\App\Action\Forward\Interceptor $result */
        if ( $result ) {
            /** @var \Magento\Framework\App\Request\Http $request */
            $request = $result->getRequest();

            if ( strpos( $request->getPathInfo(), '/catalog/category/view/' ) === 0 ) {
                //Rule provides actual URL that can be processed by a controller.
                $request->setAlias(
                    UrlInterface::REWRITE_REQUEST_PATH_ALIAS,
                    "test"
                );
                $request->setPathInfo('/' . "test" );
                return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class );
//                $modules = $this->routeConfig->getModulesByFrontName('test' );
//
//                if (!empty($modules)) {
//                    $actionClassName = $this->actionList->get( $modules[0], null, 'index', 'index');
//                    $actionInstance = $this->actionFactory->create($actionClassName);
//                    $request->setRouteName("test");
//                    var_dump($request->getRouteName());
//                    return $actionInstance;
//                }
            }
        }

        return $result;
    }
}