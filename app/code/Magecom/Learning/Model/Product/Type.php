<?php

namespace Magecom\Learning\Model\Product;

class Type extends \Magento\Catalog\Model\Product\Type\AbstractType
{
    const TYPE_ID = 'learning_product_type';

    /**
     * {@inheritdoc}
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {

    }
}