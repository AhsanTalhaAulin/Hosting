<?php

namespace Harriswebworks\Slider\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Harriswebworks\Slider\Helper\Data ;

class Pagetype extends Column
{
    
    protected $sliderHelper;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Data $sliderHelper,
        array $components = [],
        array $data = []
    ) {
        $this->sliderHelper = $sliderHelper;
       
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldval='';
            $options = $this->sliderHelper->getPageTypes();
            foreach ($dataSource['data']['items'] as &$items) {
                $pagetype = $items['page_type'];
                
                switch ($pagetype) {
                    case 0:
                        $cms_page_id = $items['cms_page_id'];
                        $fieldval = $this->_getCmspageData($cms_page_id);
                    
                        break;
                    case 1:
                        $category_id = $items['category_id'];
                        $fieldval = $this->_getCategoryData($category_id);
                    
                        break;
                    case 2:
                        $fieldval = $items['custom_route'];
                        break;
                    default:
                           $fieldval='';
                        break;
                }

                $items['page_type'] = $options[$pagetype]." : ".$fieldval;
            }
        }

        return $dataSource;
    }
    protected function _getCmspageData($cms_page_id)
    {
        $cms_pages = $this->sliderHelper->getCmsPagesAsOptions(false);
        foreach ($cms_pages as $page) {
            if ($page['value']==$cms_page_id) {
                return $page['label'];
            }
        }
        return '';
    }
    protected function _getCategoryData($category_id)
    {
        $catarray = $this->sliderHelper->getCategoriesAsOptions(false);
        foreach ($catarray as $cat) {
            if ($cat['value']==$category_id) {
                return $cat['label'];
            }
        }
        return '';
    }
}
