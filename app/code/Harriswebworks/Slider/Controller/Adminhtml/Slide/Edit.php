<?php

/**
 * Harriswebworks Grid List Controller.
 * @category  Harriswebworks
 * @package   Harriswebworks_Slider
 * @author    Harriswebworks
 * @copyright Copyright (c) 2010-2017 Harriswebworks Dhaka (https://harriswebworks.com)
 * @license   https://www.harriswebworks.com/license.html
 */

namespace Harriswebworks\Slider\Controller\Adminhtml\Slide;

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
    private $slideFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Harriswebworks\Slider\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Harriswebworks\Slider\Model\SlideFactory $slideFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->slideFactory = $slideFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $slideId = (int) $this->getRequest()->getParam('slide_id');
        $slideData = $this->slideFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($slideId) {
            $slideData = $slideData->load($slideId);

            $slideTitle = $slideData->getName();
            if (!$slideData->getSlideId()) {
                $this->messageManager->addError(__('Slide no longer exist.'));
                $this->_redirect('hww_slider/slide/slide');
                return;
            }
        }

        $this->coreRegistry->register('slide_data', $slideData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $slideId ? __('Edit Slide ') . $slideTitle : __('Add Slide');

        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Harriswebworks_Slider::edit');
    }
}
