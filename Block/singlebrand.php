<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Block;

class singlebrand extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;
    protected $brand;
    
     /**
     * BrandProductModel
     *
     * @var \Commercepundit\Brandmanagement\model\BrandProduct
     */
    protected $brandProduct;

     /**
     * productCollectionModel
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
   
    protected $_productCollectionFactory;

	 /**
     * StoreManager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Commercepundit\Brandmanagement\Model\BrandmanagementFactory $postFactory,
		\Commercepundit\Brandmanagement\Model\Singlebrand $brand,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepo
           
	)
	{
		$this->_postFactory = $postFactory;
		$this->brand = $brand;
        $this->storeManager = $storeManager;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->productRepo = $productRepo; 
        parent::__construct($context);
    }

     /**
     * Product collection
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    public function getProductCollection()
    { 
           
        $brandId = $this->getRequest()->getParam('id');
        $attributeCode = 'brand';
        $att_Code = $this->brand->getBrand_id(); 
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('brand');
        $collection->addFieldToFilter(array(array('attribute'=>$attributeCode,$att_Code),));          
        return $collection;
    }

     /**
     * BrandProducts all items
     *
     * @return BrandProducts items collection
     */
    public function getBrandProducts()
    {
        return $this->getProductCollection()->getItems();
    }
    
	public function getBrands()
    {
        $brandId = $this->getRequest()->getParam('id');   
        $brand = $this->brand->load($brandId);
        $b_image = $this->brand->getImage();
        $b_name = $this->brand->getTitle();

        return $b_image;
        return $b_name;
    }

    public function getmediaurl()
    {     
		return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . '';
		     
    } 
    
	protected function _prepareLayout()
    {  
        $brandId = $this->getRequest()->getParam('id');
        $brand = $this->brand->load($brandId);
		$name = $this->brand->getTitle();
        $bimg = $brand->getBanner_image();
        
        $breadcumb= $this->getLayout()->getBlock('breadcrumbs');
        if ($breadcumb) {
            $breadcumb->addCrumb(
                'home',
                [
                    'label' => __('Home'),
                    'title' => __('Home'),
                    'link' => $this->storeManager->getStore()->getBaseUrl()
                ]
            );
            $breadcumb->addCrumb(
                $name,
                [
                    'label' => $name,
                    'title' => $name,
                ]
            );
        }  
       
        parent::_prepareLayout();
      $valuePerPage =[]; 
        
        if ($this->getProductCollection()) {
            $toolbar = $this->getLayout()
                ->createBlock(
                    \Magento\Catalog\Block\Product\ProductList\Toolbar::class,
                    'brand.news.toolbar'
                )->setAvailableLimit($valuePerPage)
                ->setShowPerPage(true)
                ->setShowAmounts(true)
                ->setCollection(
                    $this->getProductCollection()
                );   
          
            $this->setChild('toolbar', $toolbar);
            $this->getProductCollection()->load();
        }

        return $this;
    }
	
     /**
     * Return Toolbar Html
     *
     * @return mixed
     */
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }

    /**
     * Return pager Html
     *
     * @return mixed
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * BrandProducts items
     *
     * @return BrandProducts items collection
     */
   
	public function getPostCollection(){ 
		$post = $this->_postFactory->create();   
		return $post->getCollection()->addFieldToFilter('status', 1);
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