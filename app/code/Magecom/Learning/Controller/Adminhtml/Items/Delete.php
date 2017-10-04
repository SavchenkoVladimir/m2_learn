<?php

namespace Magecom\Learning\Controller\Adminhtml\Items;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magecom\Learning\Controller\Adminhtml\Items
{
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $itemId = $this->getRequest()->getParam('item_id');

        if ($itemId) {
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $this->removeItem($itemId, $resultRedirect);
            $resultRedirect->setPath("*/*/");

            return $resultRedirect;
        }
    }

    /**
     * @param $itemId
     * @param $resultRedirect
     * @return mixed
     * @throws \Exception
     */
    protected function removeItem($itemId, $resultRedirect)
    {
        try {
            $this->itemsModel->load($itemId)->delete();
            $this->messageManager->addSuccessMessage(__('You deleted the item.'));

            return $resultRedirect->setPath("*/*/");
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(
                __('We can\'t delete this item because of an incorrect rate ID.')
            );

            return $resultRedirect->setPath("magecom_learning/*/");
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong deleting this Item.'));
        }
    }
}
