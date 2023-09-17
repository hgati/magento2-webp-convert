<?php
/**
 * @author Hgati Team
 * @copyright Copyright (c) 2021 Hgati
 * @package Hgati_Webp
 */

namespace Hgati\Webp\Controller\Adminhtml\Webp;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Hgati\Webp\Helper\Process;

class Images extends Action
{
    /** @var JsonFactory */
    private $resultJsonFactory;

    /** @var Process */
    private $process;

    /**
     * Files constructor.
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param Process $process
     */
    public function __construct(Context $context, JsonFactory $resultJsonFactory, Process $process)
    {
        parent::__construct($context);

        $this->resultJsonFactory = $resultJsonFactory;
        $this->process = $process;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $extensions = $this->getRequest()->getParam('extensions', ['*.webp']);
        $folders = $this->getRequest()->getParam('folders', []);

        $images = $this->process->getImages($extensions, $folders);
        $imagesToConversion = $this->process->getImagesToConversion($images);
        $result->setData(['images' => $images->count(), 'images_to_conversion' => count($imagesToConversion)]);

        return $result;
    }
}
