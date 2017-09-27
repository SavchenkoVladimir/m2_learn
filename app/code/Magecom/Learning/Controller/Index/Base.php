<?php

namespace Magecom\Learning\Controller\Index;

use Magento\Framework\App\Action\Context;

class Base extends \Magento\Framework\App\Action\Action
{
    /**
     * Base constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $resultPage	= $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);

        return	$resultPage;
    }
}
