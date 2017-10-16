<?php

namespace Magecom\Comment\Model;

use \Magento\Framework\Model\AbstractExtensibleModel;
use \Magecom\Comment\Api\Data\CommentInterface;

class Comment extends AbstractExtensibleModel implements CommentInterface
{
    /**
     * @inheritdoc
     */
    const CACHE_TAG = 'magecom_checkout_comment';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('Magecom\Comment\Model\ResourceModel\Comment');
    }

    /**
     * @param $orderIncrementId
     * @return mixed null/string
     */
    public function getComment($orderIncrementId)
    {
        $collection = $this->getCollection();
        $collection->addFieldToSelect('comment');
        $collection->addFieldToFilter('order_increment_id', ['eq' => $orderIncrementId]);

        return $collection->getFirstItem()->getData('comment');
    }

    /**
     * {@inheritdoc}
     *
     * @return \Magecom\Comment\Api\Data\CommentInterfaceExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \Magecom\Comment\Api\Data\CommentExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Magecom\Comment\Api\Data\CommentExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}