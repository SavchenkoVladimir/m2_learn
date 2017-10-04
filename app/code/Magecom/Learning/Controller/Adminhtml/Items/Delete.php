<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magecom\Learning\Controller\Adminhtml\Items
{
    /**
     * @return $this|\Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $itemId = $this->getRequest()->getParam('item_id');
        if ($itemId) {
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            try {
                $model = $this->itemsFactory->create();
                $model->load($itemId)->delete();
                $this->messageManager->addSuccess(__('You deleted the item.'));

                return $resultRedirect->setPath("*/*/");
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addError(
                    __('We can\'t delete this item because of an incorrect rate ID.')
                );

                return $resultRedirect->setPath("magecom_learning/*/");
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(__('Something went wrong deleting this Item.'));
            }

            if ($this->getRequest()->getServer('HTTP_REFERER')) {
                $resultRedirect->setRefererUrl();
            } else {
                $resultRedirect->setPath("*/*/");
            }

            return $resultRedirect;
        }
    }
}
