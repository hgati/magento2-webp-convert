<?php
/**
 * @author Hgati Team
 * @copyright Copyright (c) 2021 Hgati
 * @package Hgati_Webp
 */

namespace Hgati\Webp\Plugin\Filter\DirectiveProcessor;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filter\DirectiveProcessor\LegacyDirective as Subject;
use Hgati\Webp\Helper\Image;

class LegacyDirective
{
    /** @var Image */
    private $image;

    /**
     * LegacyDirective constructor.
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @param Subject $subject
     * @param string $result
     * @param array $construction
     * @return string
     */
    public function afterProcess(Subject $subject, string $result, array $construction): string
    {
        if ($construction[1] === DirectoryList::MEDIA) {
            $result = $this->image->changePath($result);
        }

        return $result;
    }
}
