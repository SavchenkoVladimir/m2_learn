<?php

namespace Magecom\Learning\Block;

class Cache extends \Magecom\Learning\Block\Items
{

    const CACHE_TAG = 'ITEMS_CACHE_TAG';

    const CACHE_ID = 'LEARNING_CACHE_ID';

    const CACHE_LIFETIME = 86400;

    const RECORD_STATUS_DISABLED = 0;

    const RECORD_STATUS_ENABLED = 1;

    const RECORD_STATUS_ARCHIVED = 2;

    protected $cache;

    protected $cacheState;


    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magecom\Learning\Model\ItemsFactory $itemsFactory
     * @param \Magecom\Learning\Model\Cache\Type $cache
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magecom\Learning\Model\ItemsFactory $itemsFactory,
        \Magecom\Learning\Model\Cache\Type $cache,
        \Magento\Framework\App\Cache\State $cacheState

    ) {
        $this->itemsFactory = $itemsFactory;
        $this->cache = $cache;
        $this->cacheState = $cacheState;
        parent::__construct($context, $itemsFactory);
    }

    /**
     * @return mixed array
     */
    public function getAllItems()
    {
        $items = $this->getCachedItems();

        return $items ? $items : $this->getDbItems();
    }

    /**
     * @param integer $status
     * @return mixed|string
     */
    public function getStatusName($status)
    {
        $statuses = [
            static::RECORD_STATUS_DISABLED => 'Disabled',
            static::RECORD_STATUS_ENABLED => 'Enabled',
            static::RECORD_STATUS_ARCHIVED => 'Archived'
        ];

        return array_key_exists($status, $statuses) ? $statuses[$status] : '';
    }

    /**
     * @return bool|string
     */
    public function getCachedItems()
    {
        if ($this->isCacheEnabled()) {
            return json_decode($this->cache->load(static::CACHE_ID), true);
        }

        return false;
    }

    /**
     * @param $items
     * @return void
     */
    public function setItemsToCache($items)
    {
        if ($this->isCacheEnabled()) {
            $this->cache->save(
                json_encode($items),
                static::CACHE_ID,
                [static::CACHE_TAG],
                static::CACHE_LIFETIME
            );
        }
    }

    /**
     * @return array/false
     */
    public function getDbItems()
    {
        $items = $this->getArray();

        if (array_key_exists('items', $items)) {
            $this->setItemsToCache($items['items']);

            return $items['items'];
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isCacheEnabled()
    {
        return $this->cacheState->isEnabled(\Magecom\Learning\Model\Cache\Type::TYPE_IDENTIFIER);
    }
}
