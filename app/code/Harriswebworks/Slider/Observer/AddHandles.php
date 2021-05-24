<?php
namespace Harriswebworks\Slider\Observer;
 
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Harriswebworks\Slider\Helper\Data ;
use Harriswebworks\Slider\Model\SliderFactory;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Registry;
 
class AddHandles implements ObserverInterface
{
    /**
     * @var SliderHelper
     */
    //const TYPE_HOME_PAGE = ;
    /*const TYPE_CMS_PAGE = 'cms';
    const TYPE_CATEGORY = 'catalog';
	const TYPE_CUSTOM_URL = 'custom';*/
    protected $pagetype = [
        'cms'=>0,
        'catalog'=>1,
        'custom'=>2,
    ];
    protected $sliderHelper;
    protected $request;
    protected $sliderFactory;
    protected $_registry;
    /**
     * Add constructor.
     * @param sliderHelper $sliderHelper

     */
 
    public function __construct(Data $sliderHelper, SliderFactory $sliderFactory, Registry $registry, Http $request)
    {
         $this->sliderHelper = $sliderHelper;
         $this->request = $request;
         $this->sliderFactory = $sliderFactory;
         $this->_registry = $registry;
    }
 
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->sliderHelper->getGeneralConfig('enable')) {
            return ;
        }
        
        $layout = $observer->getEvent()->getLayout();
        $moduleName = $this->request->getModuleName();
        $route      = $this->request->getRouteName();
        $controller = $this->request->getControllerName();
        $action     = $this->request->getActionName();
       
        //getGeneralConfig
       // $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/hww.log');
      //  $logger = new \Zend\Log\Logger();
       // $logger->addWriter($writer);
        //$logger->info('debug_backtrace');
       // $logger->info($route."_".$controller."_".$action);
        //$logger->info($this->sliderHelper->getGeneralConfig('enabled'));
        
        
       
            
            
            
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $request = $objectManager->get('Magento\Framework\App\Request\Http');
            $layoutd = $request->getFullActionName();

            $slider = $this->sliderFactory->create()->getCollection()->addFieldToFilter('status', 1);
        if ($route=='cms') {
            //$objectManagerCms = \Magento\Framework\App\ObjectManager::getInstance();
            $cmsPage = $objectManager->get('\Magento\Cms\Model\Page');
            $cmsPageId = $cmsPage->getId();
           // $logger->info($route."_".$cmsPageId);
            $slider->addFieldToFilter('page_type', $this->pagetype[$route]);
            $slider->addFieldToFilter('cms_page_id', $cmsPageId);
        } elseif ($route=='catalog' && $layoutd =='catalog_category_view') {
           // $logger->info('catalog');
            $category = $this->_registry->registry('current_category');
            $categoryid = $category->getId();
            //$logger->info($route."_".$categoryid);
            $slider->addFieldToFilter('page_type', $this->pagetype[$route]);
            $slider->addFieldToFilter('category_id', $categoryid);
        } else {
            $slider->addFieldToFilter('page_type', 2);
            $slider->addFieldToFilter('custom_route', $route."_".$controller."_".$action);
            
        }
            //$logger->info(count($slider));
            //$logger->info(print_r($slide),true);
            //$logger->info(print_r($slider->getSelect()->__toString()),true);
        if (count($slider)>0) {
            //$logger->info(count($slider),true);
            $slider_id=0;
            $slider_type = 2;
            foreach ($slider as $slideritems) {
                $slider_id = $slideritems->getData('slider_id');
                $slider_type = $slideritems->getData('slide_type');
                $slider_style = $slideritems->getData('slide_style');
            }
                
            //$slider_id = $slideritems->getData('slider_id');
            //$logger->info($slideritems->getData('slide_type'));
            if ($slider_type == 1) {
                if ($slider_style == 0) {
                    $layout->getUpdate()->addHandle('hww_slider_index_slider_owl');
                }
                if ($slider_style == 1) {
                    $layout->getUpdate()->addHandle('hww_slider_index_slider_flex');
                }
            }
            if ($slider_type == 0) {
                $layout->getUpdate()->addHandle('hww_slider_index_banner_css');
            }
            
            $this->_registry->register('hww_slider_id', $slider_id);
        }
           // $logger->info($this->_registry->registry('hww_slider_id'));
       // $logger->info('ENAMUL_ENDActun');
    }
}
