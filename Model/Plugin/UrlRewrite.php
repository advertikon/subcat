<?php
namespace Advertikon\Subcat\Model\Plugin;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\Action\Forward\Interceptor;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;

class UrlRewrite
{
    const TARGET_PATH = '/catalog/category/view/';
    const REWRITE_PATH = "test/index/index/";
    const TARGET_CATEGORY_LEVEL = 3;

    private $actionFactory;
    private $categoryRepository;

    public function __construct(
        ActionFactory $actionFactory,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->actionFactory = $actionFactory;
        $this->categoryRepository = $categoryRepository;
    }

    public function afterMatch($subject, $result)
    {
        /** @var Interceptor $result */
        /** @var Http $request */
        if ($result) {
            $request = $result->getRequest();
            $url = $request->getPathInfo();
            if (strpos($url, self::TARGET_PATH) === 0 && $this->checkCategoryLevel($url)) {
                //Rule provides actual URL that can be processed by a controller.
                $request->setAlias(UrlInterface::REWRITE_REQUEST_PATH_ALIAS, self::REWRITE_PATH);
                $request->setPathInfo('/' . self::REWRITE_PATH . substr($url, strlen(self::TARGET_PATH)));
                return $this->actionFactory->create(Forward::class);
            }
        }

        return $result;
    }

    private function checkCategoryLevel($requestPath)
    {
        $parts = explode('/', trim($requestPath, '/'));

        if (count($parts) < 5 || $parts[3] !== "id" || is_nan((int)$parts[4])) {
            return false;
        }

        $catId = (int)$parts[4];

        try {
            $category = $this->categoryRepository->get($catId);
            return $category->getLevel() == self::TARGET_CATEGORY_LEVEL;
        } catch (NoSuchEntityException $e) {
        }

        return false;
    }
}
