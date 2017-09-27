<?php

namespace Magecom\Learning\Model\ResourceModel\Items;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('Magecom\Learning\Model\Items', 'Magecom\Learning\Model\ResourceModel\Items');
    }
}
