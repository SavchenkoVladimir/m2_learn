<?php

namespace Magecom\Learning\Block;

use \Magento\Framework\View\Element\Template\Context;

class Display extends \Magento\Framework\View\Element\Template
{
    /**
     * Display constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }
}
