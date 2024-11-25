<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Model\ResourceModel;

class Singlebrand extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        //table name and id.......
        $this->_init('commercepundit_brandmanagement', 'brandmanagement_id');   
    }
}