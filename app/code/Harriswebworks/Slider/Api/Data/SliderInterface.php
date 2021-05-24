<?php

/**
 * Harriswebworks_Slider Slider Interface.
 *
 * @category    Harriswebworks
 *
 * @author      Harriswebworks Dhaka
 */

namespace Harriswebworks\Slider\Api\Data;

interface SliderInterface
{

    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ID = 'id';
    const NAME = 'name';
    const PAGE_TYPE = 'page_type';
    const CATEGORY_ID = 'category_id';
    const CUSTOM_ROUTE = 'custom_route';
    const CMS_PAGE_ID = 'cms_page_id';
    const STATUS = 'status';

    public function getId();

    public function setId($id);

    public function getName();
    
    public function setTName($name);
    
    public function getPageType();
    
    public function setPageType($page_type);
    
    public function getCategoryId();
    
    public function setCategoryId($category_id);
    
    public function getCustomRoute();
    
    public function setCustomRoute($custom_route);
    
    public function getCmsPageId();

    public function setCmsPageId($cms_page_id);

    public function getStatus();

    public function setStatus($status);
}
