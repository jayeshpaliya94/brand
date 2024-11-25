<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Model;

use Magento\Framework\Model\AbstractModel;

class Brandmanagement extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Commercepundit\Brandmanagement\Model\ResourceModel\Brandmanagement');
    }
}