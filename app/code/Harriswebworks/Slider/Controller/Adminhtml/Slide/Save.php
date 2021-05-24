<?php

/**
 * Grid Admin Cagegory Map Record Save Controller.
 * @category  Harriswebworks
 * @package   Harriswebworks_Slider
 * @author    Harriswebworks
 * @copyright Copyright (c) 2010-2017 Harriswebworks Dhaka (https://harriswebworks.com)
 * @license   https://www.harriswebworks.com/license.html
 */

namespace Harriswebworks\Slider\Controller\Adminhtml\Slide;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Harriswebworks\Slider\Model\SliderFactory
     */
    protected $_fileUploaderFactory;
    protected $slideFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Harriswebworks\Slider\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Harriswebworks\Slider\Model\SlideFactory $slideFactory
        //            , \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
    ) {
        parent::__construct($context);
//        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->slideFactory = $slideFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

//        exit;
//        image catch and upload function start
        $image = $this->getRequest()->getFiles('image');
        $fileName = ($image && array_key_exists('name', $image)) ? $image['name'] : null;
        if ($image && $fileName) {
            try {
                /** @var \Magento\Framework\ObjectManagerInterface $uploader */
                $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapterFactory */
                $imageAdapterFactory = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $uploader->setAllowCreateFolders(true);
                /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath('slider'));

                $data['image'] = 'slider' . $result['file'];
//                $model->setSlide('image' . $result['file']); //Database field name
            } catch (\Exception $e) {
                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }
        } else {
//            it will clear image field when image field is not selected
            if (isset($data['image']['delete'])) {
                $data['image'] = '';
            } else {
                unset($data['image']);
            }
        }
        //        image catch and upload function end
        
        $mobile_image = $this->getRequest()->getFiles('mobile_image');
        $fileName = ($mobile_image && array_key_exists('name', $mobile_image)) ? $mobile_image['name'] : null;
        if ($mobile_image && $fileName) {
            try {
                /** @var \Magento\Framework\ObjectManagerInterface $uploader */
                $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'mobile_image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapterFactory */
                $imageAdapterFactory = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $uploader->setAllowCreateFolders(true);
                /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath('slider'));

                $data['mobile_image'] = 'slider' . $result['file'];
//                $model->setSlide('image' . $result['file']); //Database field name
            } catch (\Exception $e) {
                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }
        } else {
//            it will clear image field when image field is not selected
            if (isset($data['mobile_image']['delete'])) {
                $data['mobile_image'] = '';
            } else {
                unset($data['mobile_image']);
            }
        }
        //        mobile image catch and upload function end


        if (!$data) {
            $this->_redirect('hww_slider/slide/edit');
            return;
        }
        try {
            $slideData = $this->slideFactory->create();
            $slideData->setData($data);
//            var_dump($slideData->getData());
//            exit;
            if (isset($data['slide_id'])) {
                $slideData->setSlideId($data['slide_id']);
            }
            $slideData->save();
            $this->messageManager->addSuccess(__('Slide has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('hww_slider/slide/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Harriswebworks_Slide::save');
    }
}
