<?php
/**
 * @author Hgati Team
 * @copyright Copyright (c) 2021 Hgati
 * @package Hgati_Webp
 */

namespace Hgati\Webp\Utils\Form\Element;

class Time extends \Magento\Framework\Data\Form\Element\Time
{
    /**
     * @inheritDoc
     */
    public function getHtmlId()
    {
        return 'time';
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'time';
    }
}
