<?php

namespace Magecom\Learning\Controller\Front;

use Magento\Framework\App\Action\Context;

class Base extends \Magento\Framework\App\Action\Action
{

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage	= $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);

        return	$resultPage;
    }
}
