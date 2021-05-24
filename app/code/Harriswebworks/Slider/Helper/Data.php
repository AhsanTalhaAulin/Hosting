<?php

namespace Harriswebworks\Slider\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;


use Magento\Backend\App\ConfigInterface;
//use Magento\Captcha\Model\CaptchaFactory;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManager;

class Data extends AbstractHelper
{

    const XML_PATH_SLIDER = 'hww_slider/';
    
    
    /**
     * Item's URL types
     */
    
    const TYPE_CMS_PAGE = 0;
    const TYPE_CATEGORY = 1;
    const TYPE_CUSTOM_URL = 2;

    /**
     * @var ConfigInterface
     */
    protected $_backendConfig;

    protected $_categoryCollection;
    protected $_categoryCollectionClass = \Magento\Catalog\Model\ResourceModel\Category\Collection::class;

   // protected $_menuCollection;
   // protected $_menuCollectionClass = \Harriswebworks\Menumanager\Model\ResourceModel\Menu\Collection::class;

    protected $_pageCollection;
    protected $_pageCollectionClass = \Magento\Cms\Model\ResourceModel\Page\Collection::class;
    
    public function __construct(
        Context $context,
        StoreManager $storeManager,
        Filesystem $filesystem,
        ConfigInterface $backendConfig,
        Registry $registry
    ) {
        $this->_coreRegistry = $registry;
        $this->_backendConfig = $backendConfig;
        parent::__construct($context);
    }
    
    
    

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getGeneralConfig($code, $storeId = 0)
    {

        return $this->getConfigValue(self::XML_PATH_SLIDER . 'general/' . $code, $storeId);
    }
    
    
     /**
      * Prepare available item url types
      *
      * @return array
      */
    public function getPageTypes()
    {
        return [
            self::TYPE_CMS_PAGE => __('CMS Page'),
            self::TYPE_CATEGORY => __('Category'),
            self::TYPE_CUSTOM_URL => __('Custom Route'),
            //self::TYPE_Product => __('Product'),
        ];
    }
    
    
    
    public function getCategoriesAsOptions($addEmptyField = true)
    {
        $collection = $this->_getCategoryCollection();
        $categories = [];

        if ($addEmptyField) {
            $categories[] = [
                'value' => '',
                'label' => __('-- Please Select --')
            ];
        }

        foreach ($collection as $category) {
            $name = $category->getName();
            $urlPath = $category->getUrlPath();

            if (isset($name) && isset($urlPath)) {
                $prefix = '';
                for ($i = 2; $i < $category->getLevel(); $i++) {
                    $prefix = $prefix . "-";
                }

                $categories[] = [
                    'value' => $category->getId(),
                    'label' => $prefix . ' ' . __($category->getName())
                ];
            }
        }

        return $categories;
    }

    /**
     * @return mixed
     */
    protected function _getCategoryCollection()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        if (!$this->_categoryCollection) {
            $collection = $objectManager->create($this->_categoryCollectionClass);
            $collection->addAttributeToSelect('name');
            $collection->addAttributeToSelect('url_path');
            $collection->addAttributeToSelect('level');

            $this->_categoryCollection = $collection;
        }

        return $this->_categoryCollection;
    }

    /**
     * @param bool|true $addEmptyField
     *
     * @return array
     */
    /*public function getMenusAsOptions($addEmptyField = true)
    {
        $collection = $this->_getMenuCollection();
        $menus = [];

        if ($addEmptyField) {
            $menus[] = array(
                'value' => '',
                'label' => __('-- Please Select --')
            );
        }

        foreach ($collection as $menu) {
            $name = $menu->getName();
            $urlPath = $menu->getUrlPath();

            if (isset($name) && isset($urlPath)) {
                $suffix = '';

                if (!$menu->getIsActive()) {
                    $suffix = __('(Inactive)');
                }

                $menus[] = [
                    'value' => $menu->getId(),
                    'label' => __($menu->getName()) . ' ' . $suffix
                ];
            }
        }

        return $menus;
    }*/

    /**
     * @return mixed
     */
   /* protected function _getMenuCollection()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        if (!$this->_menuCollection) {
            $collection = $objectManager->create($this->_menuCollectionClass);

            $this->_menuCollection = $collection;
        }

        return $this->_categoryCollection;
    }*/

    /**
     * @param bool|true $addEmptyField
     *
     * @return array
     */
    public function getCmsPagesAsOptions($addEmptyField = true)
    {
        $collection = $this->_getCmsPageCollection();
        $pages = [];

        if ($addEmptyField) {
            $pages[] = [
                'value' => '',
                'label' => __('-- Please Select --')
            ];
        }

        foreach ($collection as $page) {
            $name = $page->getTitle();
            $pageid = $page->getPageId();


            if (isset($name) && isset($pageid)) {
                $suffix = '';

                if (!$page->getIsActive()) {
                    $suffix = __('(Inactive)');
                }

                $pages[] = [
                    'value' => $pageid,
                    'label' => __($name) . ' ' . $suffix
                ];
            }
        }

        return $pages;
    }

    /**
     * @return mixed
     */
    protected function _getCmsPageCollection()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        if (!$this->_pageCollection) {
            /**
             * @var $collection \Magento\Cms\Model\ResourceModel\Page\Collection
             */
            $collection = $objectManager->create($this->_pageCollectionClass);
            $collection->addFieldToSelect('title');
            $collection->addFieldToSelect('identifier');
            $collection->addFieldToSelect('is_active');
            $collection->addFieldToSelect('page_id');

            $this->_pageCollection = $collection;
        }

        return $this->_pageCollection;
    }
}
