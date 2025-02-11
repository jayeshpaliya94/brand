<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Controller\Index;
/**
 * brand controller
 */
class Single extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;

		return parent::__construct($context);
	}

	public function execute()
	{    
		$this->_view->loadLayout();
        $this->_view->renderLayout();
	}
}