<?php

namespace Magecom\Learning\Block\Adminhtml;

class Items extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'Magecom_Learning';
        $this->_controller = 'adminhtml_items';

        parent::_construct();
    }
}
