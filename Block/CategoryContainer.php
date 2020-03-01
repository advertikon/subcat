<?php

namespace Advertikon\Subcat\Block;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Category;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template\Context;

class CategoryContainer extends \Magento\Framework\View\Element\Template
{
    private $categoryRepository;

    public function __construct(Context $context, CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($context);
        $this->categoryRepository = $categoryRepository;
    }

    public function sayHello()
    {
        return __('Hello World');
    }

    public function getChildren()
    {
        $catId = $this->_request->getParam('id', -1);

        try {
            /** @var Category $category */
            $category = $this->categoryRepository->get($catId);
            $ret = [];

            foreach ($category->getChildrenCategories() as $c) {
                $ret[] = $c->load($c->getCategoryId());
            }
            return $ret;
        } catch (NoSuchEntityException $e) {
        }

        return [];
    }
}
