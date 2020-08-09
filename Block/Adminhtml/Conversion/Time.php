<?php

namespace Unexpected\Webp\Block\Adminhtml\Conversion;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Unexpected\Webp\Utils\Form\Element\Time as TimeElement;

class Time extends Template
{
    /** @var string */
    protected $_template = 'Unexpected_Webp::conversion/time.phtml';

    /** @var TimeElement */
    private $timeElement;

    /**
     * Time constructor.
     * @param Context $context
     * @param TimeElement $timeElement
     * @param array $data
     */
    public function __construct(Context $context, TimeElement $timeElement, array $data = [])
    {
        parent::__construct($context, $data);

        $this->timeElement = $timeElement;
    }

    /**
     * @return string
     */
    public function getTimeElementHtml(): string
    {
        return $this->timeElement->getElementHtml();
    }

    /**
     * @return string
     */
    public function getTimeElementName(): string
    {
        return $this->timeElement->getName();
    }
}