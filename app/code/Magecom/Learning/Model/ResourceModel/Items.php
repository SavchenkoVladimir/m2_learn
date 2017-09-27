<?php

namespace Magecom\Learning\Model\ResourceModel;

class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Items constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('learning_items', 'item_id');
    }
}
