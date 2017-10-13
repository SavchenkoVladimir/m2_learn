<?php

namespace Magecom\Comment\Model\ResourceModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('Magecom\Comment\Model\Comment', 'Magecom\Comment\Model\ResourceModel\Comment');
    }
}
