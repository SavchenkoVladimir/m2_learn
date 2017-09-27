<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

class Edit extends \Magecom\Learning\Controller\Adminhtml\Items
{
    /**
     * Edit Item
     * @return void
     */
    public function execute()
    {
        $itemId = $this->getRequest()->getParam('item_id');
        $model = $this->itemsFactory->create();

        if ($itemId) {
            $model->load($itemId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                $this->_redirect('magecom_learning/*/');
                return;
            }
        }

        $this->coreRegistry->register('learning_items', $model);

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Items'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Item'));

        $this->_view->renderLayout();
    }
}
