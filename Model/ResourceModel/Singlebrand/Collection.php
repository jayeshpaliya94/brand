<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Model\ResourceModel\Singlebrand;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'brandmanagement_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Commercepundit\Brandmanagement\Model\Singlebrand',
            'Commercepundit\Brandmanagement\Model\ResourceModel\Singlebrand'
        );
    }
}