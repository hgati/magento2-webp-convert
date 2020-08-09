<?php

namespace Unexpected\Webp\Block\Adminhtml\Conversion;

use Magento\Backend\Block\Widget\Button;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\Store;

class Tree extends Template
{
    /**
     * @inheritDoc
     */
    protected function _prepareLayout()
    {
        $addUrl = $this->getUrl("*/*/add", ['_current' => false, 'id' => null, '_query' => false]);
        if ($this->getStore()->getId() == Store::DEFAULT_STORE_ID) {
            $this->addChild(
                'add_convert_button',
                Button::class,
                [
                    'label' => __('Convert now'),
                    'onclick' => "addNew('" . $addUrl . "', false)",
                    'class' => 'add',
                    'id' => 'add_subcategory_button',
                    'style' => ''
                ]
            );

            $this->addChild(
                'add_cron_button',
                Button::class,
                [
                    'label' => __('Cron'),
                    'onclick' => "addNew('" . $addUrl . "', true)",
                    'class' => 'add',
                    'id' => 'add_root_category_button'
                ]
            );
        }

        return parent::_prepareLayout(); // TODO: Change the autogenerated stub
    }

    /**
     * Get store from request
     *
     * @return Store
     */
    public function getStore()
    {
        $storeId = (int)$this->getRequest()->getParam('store');
        return $this->_storeManager->getStore($storeId);
    }

    /**
     * @return string
     */
    public function getAddConvertButtonHtml(): string
    {
        return $this->getChildHtml('add_convert_button');
    }

    /**
     * @return string
     */
    public function getAddCronButtonHtml(): string
    {
        return $this->getChildHtml('add_cron_button');
    }
}