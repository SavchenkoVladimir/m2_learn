<?php

namespace Magecom\Comment\Model\ResourceModel;

class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('checkout_comments', 'comment_id');
    }
}
