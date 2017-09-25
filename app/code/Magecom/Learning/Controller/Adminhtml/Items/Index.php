<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

class Index extends \Magecom\Learning\Controller\Adminhtml\Items
{

    /**
     * @return void
     */
    public function execute()
    {
        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Items'));
        $this->_view->renderLayout();
    }
}
