<?php

namespace Magecom\Learning\Model\ResourceModel;

class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('learning_items', 'item_id');
    }
}
