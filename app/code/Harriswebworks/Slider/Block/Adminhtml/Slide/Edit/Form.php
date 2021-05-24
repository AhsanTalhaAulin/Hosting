<?php

/**
 * Harriswebworks_Slider Add New Row Form Admin Block.
 * @category    Harriswebworks
 * @package     Harriswebworks_Slider
 * @author      Harriswebworks Dhaka
 *
 */

namespace Harriswebworks\Slider\Block\Adminhtml\Slide\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_wysiwygConfig;
    protected $_options;
    protected $_sliderOption;

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
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Harriswebworks\Slider\Model\Options\Status $options,
        \Harriswebworks\Slider\Model\Options\Slideroption $sliderOption,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_sliderOption = $sliderOption;
        $this->_wysiwygConfig = $wysiwygConfig;
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
        $model = $this->_coreRegistry->registry('slide_data');
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
        if ($model->getSlideId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Slide'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('slide_id', 'hidden', ['name' => 'slide_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Slide'), 'class' => 'fieldset-wide']
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
             'status',
             'select',
             [
             'name' => 'status',
             'label' => __('Status'),
             'id' => 'status',
             'title' => __('Status'),
             'values' => $this->_options->getOptionArray(),
             'class' => 'status',
             'required' => true,
                ]
         );
         $fieldset->addField(
             'slider_id',
             'select',
             [
             'name' => 'slider_id',
             'label' => __('Select Slider'),
             'id' => 'slider_id',
             'title' => __('Select Slider'),
             //            'source_model' => 'Harriswebworks\Slider\Model\Options\Slideroption',
             'values' => $this->_sliderOption->getOptionArray(),
             'class' => 'status',
             'required' => true,
                ]
         );

        $fieldset->addField(
            'image',
            'image',
            [
            'name' => 'image',
            'label' => __('Image'),
            'title' => __('Image'),
            //            'renderer' => 'Harriswebworks\Slider\Block\Adminhtml\Slide\Renderer\Image',
            //            'renderer' => 'Harriswebworks\Slider\Block\Adminhtml\Slide\Renderer\Image',
                ]
        );
        $fieldset->addField(
            'mobile_image',
            'image',
            [
            'name' => 'mobile_image',
            'label' => __('Mobile Image'),
            'title' => __('Mobile Image'),
            //            'renderer' => 'Harriswebworks\Slider\Block\Adminhtml\Slide\Renderer\Image',
            //            'renderer' => 'Harriswebworks\Slider\Block\Adminhtml\Slide\Renderer\Image',
                ]
        );

        

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'content',
            'editor',
            [
            'name' => 'content',
            'label' => __('Content'),
            'style' => 'height:36em;',
            //            'required' => true,
            'config' => $wysiwygConfig
                ]
        );
        $fieldset->addField(
            'click_url',
            'text',
            [
            'name' => 'click_url',
            'label' => __('Target URL'),
            'id' => 'click_url',
            'title' => __('Target URL'),
            //            'class' => 'required-entry',
            //            'required' => false,
                ]
        );
        
        $fieldset->addField(
            'order',
            'text',
            [
            'name' => 'order',
            'label' => __('Order'),
            'id' => 'order',
            'title' => __('Order'),
            'class' => 'order',
            'required' => true,
                ]
        );


       
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
