<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magecom\Learning\Controller\Adminhtml\Items
{

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            try {
                $model = $this->itemsFactory->create();
                $model->populateData($postData);
                $model->validate();
                $item = $model->save();

                $this->messageManager->addSuccess(__('You saved the item.'));

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('magecom_learning/*/edit', ['rule' => $item->getId()]);
                }

                return $resultRedirect->setPath('magecom_learning/*/');
            } catch (\Zend_Validate_Exception $ze) {
                $this->messageManager->addError($ze->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(__('We can\'t save this item right now.'));
            }

            $this->_objectManager->get('Magento\Backend\Model\Session')->setRuleData($postData);

            return $resultRedirect->setUrl($this->_redirect->getRedirectUrl($this->getUrl('*')));
        }

        return $resultRedirect->setPath('magecom_learning/items');
    }
}
