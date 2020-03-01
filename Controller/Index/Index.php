<?php

namespace Advertikon\Subcat\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements ActionInterface
{
    private $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * View  page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Page $page */
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->prepend(__('Categories'));

        return $page;
    }
}
