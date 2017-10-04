<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

class Edit extends \Magecom\Learning\Controller\Adminhtml\Items
{
    /**
     * @return void
     */
    public function execute()
    {
        $itemId = $this->getRequest()->getParam('item_id');

        if ($itemId) {
            $this->itemsModel->load($itemId);

            if (!$this->itemsModel->getId()) {
                $this->messageManager->addErrorMessage(__('This item no longer exists.'));
                $this->_redirect('magecom_learning/*/');
                return;
            }
        }

        $this->coreRegistry->register('learning_items', $this->itemsModel);

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Items'));
        $this->_view->getPage()
            ->getConfig()
            ->getTitle()
            ->prepend($this->itemsModel->getId() ? $this->itemsModel->getTitle() : __('New Item'));

        $this->_view->renderLayout();
    }
}
