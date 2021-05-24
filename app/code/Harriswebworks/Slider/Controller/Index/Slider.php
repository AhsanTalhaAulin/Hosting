<?php

namespace Harriswebworks\Slider\Controller\Index;

class Slider extends \Magento\Framework\App\Action\Action {

    protected $_pageFactory;
    protected $_sliderFactory;
    //protected $_helperData;

    public function __construct(
    \Magento\Framework\App\Action\Context $context, 
            
            \Magento\Framework\View\Result\PageFactory $pageFactory, 
            \Harriswebworks\Slider\Model\SliderFactory $sliderFactory

    ) {
        $this->_pageFactory = $pageFactory;
        $this->_sliderFactory = $sliderFactory;

        return parent::__construct($context);
    }

    public function execute() {


       		 return $this->_pageFactory->create();

    }

}
