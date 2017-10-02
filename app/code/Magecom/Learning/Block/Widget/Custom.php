<?php

namespace Magecom\Learning\Block\Widget;

class Custom extends \Magento\Framework\View\Element\Text implements \Magento\Widget\Block\BlockInterface
{
    protected function _beforeToHtml()
    {
        $this->setText(sprintf(
            'Custom	widget:	param1 content: %s',
            $this->getData('param1')
        ));

        return parent::_beforeToHtml();
    }
}