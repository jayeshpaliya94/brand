<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Commercepundit\Brandmanagement\Block\Adminhtml\Items\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Catalog\Model\Product\Attribute\Repository as ProductAttributeRepository;
class Main extends Generic implements TabInterface
{
   
    /**
    * @var \Magento\Catalog\Model\Product\Attribute\Repository
    */
    protected $productAttributeRepository;

    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Framework\Registry $registry, 
        \Magento\Framework\Data\FormFactory $formFactory, 
        ProductAttributeRepository $productAttributeRepository, 
        array $data = []
    ) 
    {
         parent::__construct($context, $registry, $formFactory, $data);
         $this->productAttributeRepository = $productAttributeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Brand Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Brand Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }


    public function getAttributeOptions($attributeCode)
   {               
       try {
           $attribute = $this->productAttributeRepository->get($attributeCode);
           if ($attribute) {
               return $attribute->getOptions();
           }
       } catch (\Exception $e) {
           return [];
       }
       return [];
   }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_commercepundit_brandmanagement_items');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Brand Information')]);



        if ($model->getId()) {
            $fieldset->addField('brandmanagement_id', 'hidden', ['name' => 'brandmanagement_id']);
        }
        
        $brandList = $this->getAttributeOptions('brand');
        $brandLists = [];
        foreach ($brandList as $key => $brandValue) {
            if ($brandValue->getValue() > 0) {
                $brandLists[$brandValue->getValue()] = $brandValue->getLabel();
            }
        }
        $fieldset->addField(
            'brand_id',
            'select',
            [
                'name' => 'brand_id',
                'label' => __('Brand'),
                'title' => __('Brand'),
                'options'   => $brandLists,
                'required' => true
            ]
        );

        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Description'), 'title' => __('Title'), 'required' => true]
        );
        
        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
                'required'  => false
            ]
        );
        $fieldset->addField(
            'banner_image',
            'image',
            [
                'name' => 'banner_image',
                'label' => __('banner image'),
                'title' => __('banner_image'),
                'required'  => false
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status', 'label' => __('Status'), 'title' => __('Status'),  'options'   => [0 => 'Disable', 1 => 'Enable'], 'required' => true]
        );
       
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
