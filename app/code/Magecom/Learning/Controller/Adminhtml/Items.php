<?php

namespace Magecom\Learning\Controller\Adminhtml;

abstract class Items extends \Magento\Backend\App\AbstractAction
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * User model factory
     *
     * @var \Magecom\Learning\Model\ItemsFactory
     */
    protected $itemsFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magecom\Learning\Model\ItemsFactory $itemsFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magecom\Learning\Model\ItemsFactory $itemsFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->itemsFactory = $itemsFactory;
    }

    /**
     * @return $this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();

        return $this;
    }
}
