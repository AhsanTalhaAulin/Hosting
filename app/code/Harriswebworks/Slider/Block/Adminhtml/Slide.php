<?php
namespace Harriswebworks\Slider\Block\Adminhtml;

class Slide extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_slide';
        $this->_blockGroup = 'Harriswebworks_Slide';
        $this->_headerText = __('Slide');
        $this->_addButtonLabel = __('Create New Slide');
        parent::_construct();
    }
}
