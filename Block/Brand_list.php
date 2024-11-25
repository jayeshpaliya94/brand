<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Block;

use Magento\Framework\View\Element\Template;
use Commercepundit\Brandmanagement\Model\BrandmanagementFactory;

/**
 * brand List block
 */
class Demo extends Template
{
    protected $_brandList;
    
    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        BrandmanagementFactory $brandList
    ) {
        parent::__construct($context, $data);
        $this->_brandList = $brandList;
    }
 
    public function getBrandData()
    {
         /**
         * Retrieve brand Data
         *
         */
        $test = $this->_brandList->create();
        $collection = $test->getCollection()
        ->addFieldToFilter('status', 1);
        return $collection;
    }
}