<?php


namespace Advertikon\Subcat\Block;

class CategoryContainer extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
        var_dump("ssdsd");
    }

    public function sayHello()
    {
        return __('Hello World');
    }
}