<?php

namespace Unexpected\Webp\Block\Adminhtml\Conversion\Buttons;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ConvertNowButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        $url = $this->getConvertNowUrl();

        return [
            'label' => __('Convert now'),
            'on_click' => "setLocation('${url}')",
            'class' => '',
            'sort_order' => 10,
        ];
    }

    /**
     * @return string
     */
    private function getConvertNowUrl(): string
    {
        return $this->getUrl('*/*/*', ['id' => 'convert_now']);
    }
}