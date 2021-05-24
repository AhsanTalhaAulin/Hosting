<?php

/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Bannerslider
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

namespace Harriswebworks\Slider\Controller\Adminhtml\Slider;

//use Magento\Framework\Controller\ResultFactory;

/**
 * Delete Slider action
 * @category Magestore
 * @package  Magestore_Bannerslider
 * @module   Bannerslider
 * @author   Magestore Developer
 */
class Delete extends \Magento\Backend\App\Action
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
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($context);
//        $this->coreRegistry = $coreRegistry;
//        $this->sliderFactory = $sliderFactory;
    }

    public function execute()
    {
        $sliderId = $this->getRequest()->getParam('slider_id');
        $model = $this->_objectManager->create('Harriswebworks\Slider\Model\Slider');
        $model = $model->setSliderId($sliderId);
//        var_dump($model);
//        echo 'tesss';


//        echo $sliderId;
//        exit;
        try {
//            $slider = $this->_sliderFactory->create()->setId($sliderId);
            $model->delete();
            $this->messageManager->addSuccess(
                __('Slider Delete Successfully')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
