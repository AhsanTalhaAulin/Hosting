<?php

namespace Harriswebworks\Slider\Model\ResourceModel\Slider;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'slider_id';
    protected $_eventPrefix = 'hww_slider_slider_collection';
    protected $_eventObject = 'slider_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Harriswebworks\Slider\Model\Slider', 'Harriswebworks\Slider\Model\ResourceModel\Slider');
    }
}
