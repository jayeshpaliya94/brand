<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Commercepundit\Brandmanagement\Controller\Adminhtml\Items;

class NewAction extends \Commercepundit\Brandmanagement\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
