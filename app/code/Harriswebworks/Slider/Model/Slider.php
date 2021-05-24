<?php

namespace Harriswebworks\Slider\Model;

class Slider extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'harriswebworks_slider';

    protected $_cacheTag = 'harriswebworks_slider';
    protected $_eventPrefix = 'harriswebworks_slider';

    protected function _construct()
    {
        $this->_init('Harriswebworks\Slider\Model\ResourceModel\Slider');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getSliderId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    /**
     * Get EntityId.
     *
     * @return int
     */
//    public function getId() {
//        return $this->getData(self::ID);
//    }
//    public function setId($id) {
//        return $this->setData(self::ID, $id);
//    }
//    public function getName() {
//        return $this->getData(self::NAME);
//    }
//    public function setName($name) {
//        return $this->setData(self::NAME, $name);
//    }
//    public function getStatus() {
//        return $this->getData(self::STATUS);
//    }
//    public function setStatus($status) {
//        return $this->setData(self::STATUS, $status);
//    }
}
