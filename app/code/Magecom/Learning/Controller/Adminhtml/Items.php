<?php

namespace Magecom\Learning\Controller\Adminhtml;

abstract class Items extends \Magento\Backend\App\AbstractAction
{

    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var \Magecom\Learning\Api\Data\ItemsInterface
     */
    protected $itemsModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magecom\Learning\Api\Data\ItemsInterface $itemsModel
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magecom\Learning\Api\Data\ItemsInterface $itemsModel
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->itemsModel = $itemsModel;
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
