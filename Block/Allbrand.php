<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Block;

class Allbrand extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Commercepundit\Brandmanagement\Model\BrandmanagementFactory $postFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager
	)
	{
		$this->_postFactory = $postFactory;
		$this->storeManager = $storeManager;
		parent::__construct($context);
	}

	 /**
     * Get Brand items
     *
     * @return Brand items collection
     */
	public function getPostCollection(){ 
		$post = $this->_postFactory->create();   
		return $post->getCollection()->addFieldToFilter('status', 1);
	}

	 /**
     * Get media Url
     *
     * @return url
     */
	public function getStoreManagerData()
    {     
		return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . '';
		     
	} 
	 /**
     * Get Base Url
     *
     * @return Baseurl
     */

	public function getBase()
    {     
		return $this->_storeManager->getStore()->getBaseUrl(). '';
		     
	}
	
	public function getBrandUrl($brandId, $brandUrl = '')
    {  
        $urlRewriteModel = $this->urlRewriteFactory->create();
        $urlRewriteData = $urlRewriteModel->getCollection()
            ->addFieldToFilter('request_path', $brandUrl);
        if (!empty($urlRewriteData->getData())) {
            $url=$this->getUrl($urlRewriteData->getData()[0]['request_path']);
        } else {
            $url=$this->getUrl('brands/index', ['id'=>$brandId]);
        }

        return $url;
    }
}