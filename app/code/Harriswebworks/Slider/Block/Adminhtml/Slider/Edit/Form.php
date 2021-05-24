<?php

/**
 * Harriswebworks_Slider Add New Row Form Admin Block.
 * @category    Harriswebworks
 * @package     Harriswebworks_Slider
 * @author      Harriswebworks Dhaka
 *
 */

namespace Harriswebworks\Slider\Block\Adminhtml\Slider\Edit;


use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $sliderHelper;
    protected $jsonEncoder;
    protected $slidetype;
    protected $slidestyle;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Harriswebworks\Slider\Model\Options\Status $options,
        array $data = [],
        \Harriswebworks\Slider\Model\Options\Slidetype $slidetype,
        \Harriswebworks\Slider\Model\Options\Slidestyle $slidestyle,
        \Harriswebworks\Slider\Helper\Data $sliderHelper,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder
    ) {
        $this->_options = $options;
        $this->slidetype = $slidetype;
        $this->slidestyle = $slidestyle;
        $this->_sliderHelper = $sliderHelper;
        $this->jsonEncoder = $jsonEncoder;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('slider_data');
        $slider_type = $model->getSlider_type();
        $form = $this->_formFactory->create(
            ['data' => [
                        'id' => 'edit_form',
                        'enctype' => 'multipart/form-data',
                        'action' => $this->getData('action'),
                        'method' => 'post'
                    ]
                ]
        );

        $form->setHtmlIdPrefix('hww_slider_');
        $htmlIdPrefix = $form->getHtmlIdPrefix();
        if ($model->getSliderId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Slider'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('slider_id', 'hidden', ['name' => 'slider_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Slider'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'name',
            'text',
            [
            'name' => 'name',
            'label' => __('Name'),
            'id' => 'name',
            'title' => __('Name'),
            'class' => 'required-entry',
            'required' => true,
                ]
        );
        $fieldset->addField(
            'page_type',
            'select',
            [
                'label' => __('Page Type'),
                'title' => __('Page Type'),
                'name' => 'page_type',
                'data-action' => 'slider-item-page-type',
                'required' => true,
                'options' => $this->_sliderHelper->getPageTypes(),
            ]
        );

        $field = $fieldset->addField(
            'custom_route',
            'text',
            [
                'name' => 'custom_route',
                'label' => __('Custom Route'),
                'title' => __('Custom Route'),
                'required' => true,
            ]
        );

        $this->_addCategoryField($fieldset);

        $this->_addCmsPageSelect($fieldset);

        $fieldset->addField(
            'slide_type',
            'select',
            [
            'name' => 'slide_type',
            'label' => __('Slide Type'),
            'id' => 'slide_type',
            'title' => __('Status'),
            'values' => $this->slidetype->getOptionArray(),
            'class' => 'slide_type',
            'required' => true,
                ]
        );
        /*$fieldset->addField(
            'slide_style',
            'select',
            [
            'name' => 'slide_style',
            'label' => __('Slide Style'),
            'id' => 'slide_style',
            'title' => __('Status'),
            'values' => $this->slidestyle->getOptionArray(),
            'class' => 'slide_style',
            'display' => 'none'
                ],
            'slide_type'
        );*/
        $fieldset->addField(
            'status',
            'select',
            [
            'name' => 'status',
            'label' => __('Status'),
            'id' => 'status',
            'title' => __('Status'),
            'values' => $this->_options->getOptionArray(),
            'class' => 'status',
            'required' => false,
                ]
        );

        $fieldset->addField(
            'slider_autoplay',
            'select',
            [
            'name' => 'slider_autoplay',
            'label' => __('Slider Autoplay'),
            'id' => 'slider_autoplay',
            'title' => __('Slider Autoplay'),
            'values' => [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]],
            'class' => 'slider_autoplay',
            'required' => false,
                ]
        );

        $fieldset->addField(
            'slider_nav',
            'select',
            [
            'name' => 'slider_nav',
            'label' => __('Slider Nav'),
            'id' => 'slider_nav',
            'title' => __('Slider Nav'),
            'values' => [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]],
            'class' => 'slider_nav',
            'required' => false,
                ]
        );
        $fieldset->addField(
            'slider_dots',
            'select',
            [
            'name' => 'slider_dots',
            'label' => __('Slider Dots'),
            'id' => 'slider_dots',
            'title' => __('Slider Dots'),
            'values' => [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]],
            'class' => 'slider_dots',
            'required' => false,
                ]
        );
        $fieldset->addField(
            'autoplayhoverpause',
            'select',
            [
            'name' => 'autoplayhoverpause',
            'label' => __('Autoplay Hover Pause'),
            'id' => 'autoplayhoverpause',
            'title' => __('Autoplay Hover Pause'),
            'values' => [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]],
            'class' => 'autoplayhoverpause',
            'required' => false,
                ]
        );
        $fieldset->addField(
            'slider_lazyLoad',
            'select',
            [
            'name' => 'slider_lazyLoad',
            'label' => __('Slider Lazyload'),
            'id' => 'slider_lazyLoad',
            'title' => __('Slider Lazyload'),
            'values' => [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]],
            'class' => 'slider_lazyLoad',
            'required' => false,
                ]
        );
        /*$fieldset->addField(
            'autoplay',
            'select',
            [
                'name'        => 'slider_setting[autoplay]',
                'label'    => __('Autoplay'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'nav',
            'select',
            [
                'name'        => 'slider_setting[nav]',
                'label'    => __('Navigation'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'dots',
            'select',
            [
                'name'        => 'slider_setting[dots]',
                'label'    => __('Dots'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'autoplayHoverPause',
            'select',
            [
                'name'        => 'slider_setting[autoplayHoverPause]',
                'label'    => __('Stop On Hover'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'lazyLoad',
            'select',
            [
                'name'        => 'slider_setting[lazyLoad]',
                'label'    => __('Scroll Per Page'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );*/

        // Added by Nazmul
        /*$model = $this->_coreRegistry->registry('slider_data');
        $defaultSetting = array('items'=>1, 'itemsDesktop'=>'[1199,1]', 'itemsDesktopSmall' => '[980,3]', 'itemsTablet' => '[768,2]', 'itemsMobile' => '[479,1]', 'slideSpeed' => 500);
        $setting = $model->getSliderSetting();
        $getName = $model->getName();
        $data = array_merge($defaultSetting, $setting);
        $fieldset->addField(
            'autoplay',
            'select',
            [
                'name'        => 'slider_setting[autoplay]',
                'label'    => __('Autoplay'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'nav',
            'select',
            [
                'name'        => 'slider_setting[nav]',
                'label'    => __('Navigation'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'dots',
            'select',
            [
                'name'        => 'slider_setting[dots]',
                'label'    => __('Dots'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'autoplayHoverPause',
            'select',
            [
                'name'        => 'slider_setting[autoplayHoverPause]',
                'label'    => __('Stop On Hover'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'lazyLoad',
            'select',
            [
                'name'        => 'slider_setting[lazyLoad]',
                'label'    => __('Scroll Per Page'),
                'required'     => false,
                'values'=> [['value'=>false, 'label'=> __('False')], ['value'=>true, 'label'=> __('True')]]
            ]
        );
        $fieldset->addField(
            'items',
            'text',
            [
                'name'        => 'slider_setting[items]',
                'label'    => __('Items'),
                'required'     => true,
                'class' => 'validate-number', 
                'default'=> 1
            ]
        );
        $fieldset->addField(
            'slideSpeed',
            'text',
            [
                'name'        => 'slider_setting[slideSpeed]',
                'label'    => __('Slide Speed'),
                'required'     => true,
                'class' => 'validate-number', 
                'default'=> 1
            ]
        );
        $fieldset->addField(
            'itemsDesktop',
            'text',
            [
                'name'        => 'slider_setting[itemsDesktop]',
                'label'    => __('Items Desktop'),
                'required'     => true
            ]
        );*/
        
        $field->setAfterElementHtml('<script type="text/x-magento-init">
			{
				"*": {
					"Harriswebworks_Slider/slider-actions-handler": {}
				}
			}
		</script>');
        
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        //$this->setForm($form);
        $this->setChild(
            'form_after',
            $this->getLayout()->createBlock(
                'Magento\Backend\Block\Widget\Form\Element\Dependence'
            )->addFieldMap(
                "{$htmlIdPrefix}slide_type",
                'slide_type'
            )
                ->addFieldMap(
                    "{$htmlIdPrefix}slide_style",
                    'slide_style'
                )
                ->addFieldDependence(
                    'slide_style',
                    'slide_type',
                    '1'
                )
        );

        $this->setForm($form);
        return parent::_prepareForm();
    }
    
    
    /**
     * @param $fieldset
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _addCategoryField(\Magento\Framework\Data\Form\Element\Fieldset $fieldset)
    {
        $fieldset->addField(
            'category_id',
            'select',
            [
                'label' => __('Category'),
                'title' => __('Category'),
                'values' => $this->_sliderHelper->getCategoriesAsOptions(true),
                'name' => 'category_id',
                'required' => true
            ]
        );
    }

    protected function _addCmsPageSelect(\Magento\Framework\Data\Form\Element\Fieldset $fieldset)
    {
        $fieldset->addField(
            'cms_page_id',
            'select',
            [
                'label' => __('CMS Page'),
                'title' => __('CMS Page'),
                'values' => $this->_sliderHelper->getCmsPagesAsOptions(true),
                'name' => 'cms_page_id',
                'required' => true
            ]
        );
        

    }

   
}
