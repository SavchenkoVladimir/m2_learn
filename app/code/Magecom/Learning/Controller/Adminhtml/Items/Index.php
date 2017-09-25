<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

class Index extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        $page = $this->resultPageFactory->create();
        $page->setActiveMenu('Magecom_Learning::items');
        $page->getConfig()->getTitle()->prepend(__('Items'));

        return $page;
    }
}
