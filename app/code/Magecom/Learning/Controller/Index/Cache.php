<?php

namespace Magecom\Learning\Controller\Index;

class Cache extends \Magento\Framework\App\Action\Action
{

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $resultPage	= $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);

        return	$resultPage;
    }
}
