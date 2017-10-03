<?php

namespace Magecom\Learning\Block;

use \Magento\Framework\View\Element\Template\Context;

class Items extends \Magento\Framework\View\Element\Template
{

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var \Magecom\Learning\Model\ItemsFactory
     */
    public $itemsFactory;

    /**
     * Items constructor.
     * @param Context $context
     * @param \Magecom\Learning\Model\ItemsFactory $itemsFactory
     */
    public function __construct(
        Context $context,
        \Magecom\Learning\Model\ItemsFactory $itemsFactory
    ) {
        $this->itemsFactory = $itemsFactory;
        parent::__construct($context);
    }

    /**
     * @return array
     */
    protected function getArray()
    {
        if (empty($this->items)) {
            $itemsFactory = $this->itemsFactory->create();
            $this->items = $itemsFactory->getArray();
        }

        return $this->items;
    }

    /**
     * @return mixed array
     */
    public function getAllItems()
    {
        $items = $this->getArray();

        return $items['items'];
    }

    /**
     * @return string
     */
    public function getItemsCount()
    {
        $items = $this->getArray();

        return $items['totalRecords'];
    }
}
