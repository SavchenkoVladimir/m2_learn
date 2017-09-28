<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

class Index extends \Magecom\Learning\Controller\Adminhtml\Items
{

    /**
     * @return void
     */
    public function execute()
    {
        \Magento\Framework\Profiler::start(__CLASS__ . '::' . __METHOD__);

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Items'));
        $this->_view->renderLayout();

        \Magento\Framework\Profiler::stop(__CLASS__ . '::' . __METHOD__);
    }
}
