<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Controller\Adminhtml\Items;

use Commercepundit\Brandmanagement\Model\BrandmanagementFactory;

class Delete extends \Commercepundit\Brandmanagement\Controller\Adminhtml\Items
{

     /**
     * @var BrandmanagementFactory
     */
    protected $BrandmanagementFactory;

     /**
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param faqFactory|null $faqFactory
     */
    public function __construct(
       Context $context,
        FileFactory $fileFactory,
        BrandmanagementFactory $brandFactory
    ) {   
        $this->brandFactory = $brandFactory;
        parent::__construct($context, $fileFactory);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->brandFactory->create()->load($id);

                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the item.'));
                $this->_redirect('commercepundit_brandmanagement/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t delete item right now. Please review the log and try again.')
                );
                 $this->_redirect('commercepundit_brandmanagement/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a item to delete.'));
        $this->_redirect('commercepundit_brandmanagement/*/');
    }
}
    