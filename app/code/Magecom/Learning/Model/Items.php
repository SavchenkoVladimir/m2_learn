<?php

namespace Magecom\Learning\Model;

class Items extends \Magento\Framework\Model\AbstractModel
{
    const CACHE_TAG = 'magecom_learning_items';

    protected function _construct()
    {
        $this->_init('Magecom\Learning\Model\ResourceModel\Items');
    }

    /**
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function getArray($limit = null, $offset= null)
    {
        $collection = $this->getCollection()
            ->addFieldToSelect('item_id')
            ->addFieldToSelect('title')
            ->addFieldToSelect('creation_time');

        if ($limit) {
            $collection->setPageSize($limit);
        }

        if ($offset) {
            $collection->setCurPage($offset);
        }

        return $collection->toArray();
    }
}