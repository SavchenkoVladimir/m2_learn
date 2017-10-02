<?php

namespace Magecom\Learning\Model\Items\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class IsActive implements OptionSourceInterface
{
    /**
     * @var \Magecom\Learning\Model\Items
     */
    protected $items;

    /**
     * IsActive constructor.
     * @param \Magecom\Learning\Model\Items $items
     *
     */
    public function __construct(\Magecom\Learning\Model\Items $items)
    {
        $this->items = $items;
    }

    /**
     * Get options
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
