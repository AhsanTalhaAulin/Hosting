<?php

namespace Harriswebworks\Slider\Block;

use Magento\Framework\View\Element\Template\Context;
use Harriswebworks\Slider\Model\SliderFactory;
use Harriswebworks\Slider\Model\SlideFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
//use Harriswebworks\Slider\Helper\Data;
use Magento\Framework\Registry;

class Slider extends \Magento\Framework\View\Element\Template implements \Magento\Framework\DataObject\IdentityInterface
{

    protected $_sliderFactory;
    protected $_slideFactory;
//    protected $_helperData;
	/**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;
    protected $_sliderId;
    protected $_storeManager;
    protected $_urlInterface;
    protected $_scopeConfig;
    protected $_registry;
    
    public function __construct(
        Context $context,
        //            Data $helperData,
        SliderFactory $sliderFactory,
        SlideFactory $slideFactory,
        StoreManagerInterface $storeManager,
        UrlInterface $urlInterface,
        ScopeConfigInterface $scopeConfig,
        Registry $registry,
		\Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data = []
    ) {
		$this->_filterProvider = $filterProvider;
        parent::__construct($context, $data);
        $this->_sliderFactory = $sliderFactory;
        $this->_slideFactory = $slideFactory;
        $this->_storeManager = $storeManager;
        $this->_urlInterface = $urlInterface;
        $this->_scopeConfig = $scopeConfig;
        $this->_registry = $registry;
		
//        $this->$_helperData = $helperData;
    }

/**
     * Initialize block's cache
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->addData(
            ['cache_lifetime' => 864000, 'cache_tags' => [\Harriswebworks\Slider\Model\Slider::CACHE_TAG]]
        );
    }
/**
     * Get Key pieces for caching block content
     *
     * @return array
     */
    public function getCacheKeyInfo()
    {
        return [
           'HARRISWEBWORKS_SLIDER_SLIDER',
           $this->_storeManager->getStore()->getId(),
           $this->_design->getDesignTheme()->getId(),
           $this->_registry->registry('hww_slider_id'),
           'template' => $this->getTemplate()
        ];
    }

//    public function get
    public function isActiveExtension()
    {
        return $this->_scopeConfig->getValue('hww_slider/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getSlider()
    {

        if ($this->isActiveExtension() == 0) {
            return [];
        }
        $this->_sliderId = $this->_registry->registry('hww_slider_id');//$this->getSliderId();
        $slide = $this->_slideFactory->create()->getCollection()->addFieldToFilter('status', 1);
        if ($this->_sliderId != '') {
            $slide->addFieldToFilter('slider_id', $this->_sliderId);
        }
        return $slide;
    }
    public function getSliderId(){
        return $this->_registry->registry('hww_slider_id');
    }
    public function getBannerCollection()
    {
        $this->_sliderId = $this->_registry->registry('hww_slider_id');
        if(!$this->_sliderId)
            return [];
        $collection = $this->_sliderFactory->create()->getCollection();
        $collection->addFieldToFilter('slider_id', $this->_sliderId);
        return $collection;
    }

    public function getImageUrl($img = '')
    {
        $img_url = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $img;
        return $img_url;
    }
	/**
     * Prepare HTML content
     *
     * @return string
     */
	
    public function getCmsFilterContent($value='')
    {
        $html = $this->_filterProvider->getPageFilter()->filter($value);
        return $html;
    }
	 public function getIdentities()
    {
        return [\Harriswebworks\Slider\Model\Slide::CACHE_TAG];
    }
}
