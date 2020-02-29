<?php

namespace Advertikon\Subcat\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action implements ActionInterface
{
    private $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
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
        /** @var \Magento\Framework\View\Result\Page $page */
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->prepend(__('Custom Front View'));
        var_dump("foo" );

        return $page;
    }
}