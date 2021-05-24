<?php

/**
 * Harriswebworks Grid List Controller.
 * @category  Harriswebworks
 * @package   Harriswebworks_Slider
 * @author    Harriswebworks
 * @copyright Copyright (c) 2010-2017 Harriswebworks Dhaka (https://harriswebworks.com)
 * @license   https://www.harriswebworks.com/license.html
 */

namespace Harriswebworks\Slider\Controller\Adminhtml\Slider;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Harriswebworks\Slider\Model\GridFactory
     */
    private $sliderFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Harriswebworks\Slider\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Harriswebworks\Slider\Model\SliderFactory $sliderFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->sliderFactory = $sliderFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $sliderId = (int) $this->getRequest()->getParam('slider_id');
        $sliderData = $this->sliderFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($sliderId) {
            $sliderData = $sliderData->load($sliderId);

            $sliderTitle = $sliderData->getTitle();
            if (!$sliderData->getSliderId()) {
                $this->messageManager->addError(__('Slider no longer exist.'));
                $this->_redirect('hww_slider/slider/slider');
                return;
            }
        }

        $this->coreRegistry->register('slider_data', $sliderData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $sliderId ? __('Edit Slider ') . $sliderTitle : __('Add Slider');

        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Harriswebworks_Slider::edit');
    }
}
