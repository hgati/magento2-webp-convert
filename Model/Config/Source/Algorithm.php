<?php
/**
 * @author Hgati Team
 * @copyright Copyright (c) 2021 Hgati
 * @package Hgati_Webp
 */

namespace Hgati\Webp\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Algorithm implements OptionSourceInterface
{
    const WEBP_ALGORITHM = 'webp';
    const CWEBP_ALGORITHM = 'cwebp';
    const VIPS_ALGORITHM = 'vips';

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        $optionArray = [];
        foreach ($this->toArray() as $key => $value) {
            $optionArray[] = [
                'value' => $key,
                'label' => $value
            ];
        }
        return $optionArray;
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            self::WEBP_ALGORITHM => __('Webp by php'),
            self::CWEBP_ALGORITHM => __('Cwebp by command line'),
            self::VIPS_ALGORITHM => __('Vips by command line'),
        ];
    }
}
