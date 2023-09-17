<?php
/**
 * @author Hgati Team
 * @copyright Copyright (c) 2021 Hgati
 * @package Hgati_Webp
 */

namespace Hgati\Webp\Test\Unit\Traits;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

trait TraitObjectManager
{
    /** @var ObjectManager */
    private $objectManager;

    /**
     * @return ObjectManager
     */
    private function getObjectManager(): ObjectManager
    {
        if (null === $this->objectManager) {
            $this->objectManager = new ObjectManager($this);
        }

        return $this->objectManager;
    }
}
