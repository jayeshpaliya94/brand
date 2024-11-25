<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Commercepundit\Brandmanagement\Controller\Adminhtml\Items;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Commercepundit\Brandmanagement\Controller\Adminhtml\Items;
class Edit extends Items implements HttpGetActionInterface
{
 

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');   
        $model = $this->_brandFactory->create();
        
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('commercepundit_brandmanagement/*');
                return;
            }
        }
        
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_commercepundit_brandmanagement_items', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('items_items_edit');
        $this->_view->renderLayout();
    }
}
