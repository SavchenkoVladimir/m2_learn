<?php

namespace  Magecom\Learning\Plugin;

class ProductPlugin
{
    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return string
     */
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result . ' low price';
    }
}