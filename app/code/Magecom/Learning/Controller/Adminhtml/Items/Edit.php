<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

use Magento\Framework\Locale\Resolver;

class Edit extends \Magecom\Learning\Controller\Adminhtml\Items
{
    /**
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
        } else {
            $model->setInterfaceLocale(Resolver::DEFAULT_LOCALE);
        }

//        // Restore previously entered form data from session
//        $data = $this->_session->getUserData(true);
//        if (!empty($data)) {
//            $model->setData($data);
//        }

//        $this->_coreRegistry->register('permissions_user', $model);
//
//        if (isset($userId)) {
//            $breadcrumb = __('Edit User');
//        } else {
//            $breadcrumb = __('New User');
//        }
//        $this->_initAction()->_addBreadcrumb($breadcrumb, $breadcrumb);

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Items'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Item'));

        $this->_view->renderLayout();
    }
}
