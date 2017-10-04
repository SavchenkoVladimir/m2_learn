<?php

namespace Magecom\Learning\Model\System\Config;

use Magento\Framework\Data\OptionSourceInterface;

class State implements OptionSourceInterface
{
    /**
     * @var \Magecom\Learning\Model\Items
     */
    protected $items;

    /**
     * @param \Magecom\Learning\Model\Items $items
     */
    public function __construct(\Magecom\Learning\Model\Items $items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->items->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}

