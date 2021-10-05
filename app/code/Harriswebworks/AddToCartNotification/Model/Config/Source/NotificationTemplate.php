<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Harriswebworks\AddToCartNotification\Model\Config\Source;

class NotificationTemplate implements \Magento\Framework\Option\ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => 0, 'label' => __('Sticky Notification')],
            ['value' => 1, 'label' => __('Magento Modal')]
        ];
    }

}
