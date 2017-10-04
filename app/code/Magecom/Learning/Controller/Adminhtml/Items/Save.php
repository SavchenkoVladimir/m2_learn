<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\InputException;

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

                $this->itemsModel->populateData($postData);
                $this->itemsModel->validate();
                $item = $this->itemsModel->save();

                $this->messageManager->addSuccessMessage(__('You saved the item.'));

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('magecom_learning/*/edit', ['item_id' => $item->getId()]);
                }

                return $resultRedirect->setPath('magecom_learning/*/');
            } catch (InputException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('We can\'t save this item right now.'));
            }

            $this->_objectManager->get('Magento\Backend\Model\Session')->setRuleData($postData);

            return $resultRedirect->setUrl($this->_redirect->getRedirectUrl($this->getUrl('*')));
        }

        return $resultRedirect->setPath('magecom_learning/items');
    }
}
