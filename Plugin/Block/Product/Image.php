<?php
/**
 * @author Hgati Team
 * @copyright Copyright (c) 2021 Hgati
 * @package Hgati_Webp
 */

namespace Hgati\Webp\Plugin\Block\Product;

use Magento\Catalog\Block\Product\Image as Subject;
use Hgati\Webp\Helper\Image as ImageHelper;

class Image
{
    /** @var ImageHelper */
    private $imageHelper;

    /**
     * Image constructor.
     * @param ImageHelper $imageHelper
     */
    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    /**
     * @param Subject $subject
     * @param $result
     * @param string $method
     * @return string
     */
    public function after__call(Subject $subject, $result, string $method)
    {
        if ($method == 'getImageUrl' && $subject->getProductId() > 0) {
            $result = $this->imageHelper->changePath($result);
        }

        return $result;
    }
}
