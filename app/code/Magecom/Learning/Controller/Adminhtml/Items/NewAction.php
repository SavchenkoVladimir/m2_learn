<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

class NewAction extends \Magecom\Learning\Controller\Adminhtml\Items
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
