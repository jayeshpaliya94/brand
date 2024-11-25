<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Commercepundit\Brandmanagement\Controller\Adminhtml\Items;

class Index extends \Commercepundit\Brandmanagement\Controller\Adminhtml\Items
{
    /**
     * Brand list.
     *
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Commercepundit_Brandmanagement::brand');
        $resultPage->getConfig()->getTitle()->prepend(__('Brand Items'));
        $resultPage->addBreadcrumb(__('brand'), __('brand'));
        $resultPage->addBreadcrumb(__('Brand'), __('Brand'));
        return $resultPage;
    }
}