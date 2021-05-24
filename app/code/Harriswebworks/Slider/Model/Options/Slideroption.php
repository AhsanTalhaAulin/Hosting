<?php

/**
 * Harriswebworks_Slider Status Options Model.
 * @category    Harriswebworks
 * @author      Harriswebworks Dhaka
 */

namespace Harriswebworks\Slider\Model\Options;

use Magento\Framework\Data\OptionSourceInterface;

class Slideroption implements \Magento\Framework\Option\ArrayInterface
{

    protected $_sliderFactory;
    protected $_sliderCollection;

    public function _construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Harriswebworks\Slider\Model\ResourceModel\Slider\Collection $sliderCollection,
        \Harriswebworks\Slider\Model\SliderFactory $sliderFactory
    ) {
        $this->_sliderFactory = $sliderFactory;
        $this->_sliderCollection = $sliderCollection;
        parent::_construct($context);
    }

    public function getOptionArray()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $slider = $objectManager->create('Harriswebworks\Slider\Model\ResourceModel\Slider\Collection')->addFieldToFilter('status', 1);
        $options = [];
        foreach ($slider as $item) {
            $options[$item->getSliderId()] = $item->getName();
        }
        return $options;
    }

    /**
     * Get Grid row status labels array with empty value for option element.
     *
     * @return array
     */
    public function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);
        return $res;
    }

    /**
     * Get Grid row type array for option element.
     * @return array
     */
    public function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getOptions();
    }
}
