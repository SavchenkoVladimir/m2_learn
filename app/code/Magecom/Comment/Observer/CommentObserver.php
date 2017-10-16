<?php

namespace Magecom\Comment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Zend\Json\Server\Exception\ErrorException;

class CommentObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Webapi\Rest\Request
     */
    protected $request;

    /**
     * @var \Magecom\Comment\Model\ResourceModel\Comment
     */
    protected $commentModel;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * CommentObserver constructor.
     * @param \Magento\Framework\Webapi\Rest\Request $request
     * @param \Magecom\Comment\Model\Comment $commentModel
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request,
        \Magecom\Comment\Model\Comment $commentModel,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->request = $request;
        $this->commentModel = $commentModel;
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return Observer
     */
    public function execute(Observer $observer)
    {
        try {
            $order = $observer->getOrder();
            $requestBody = $this->request->getBodyParams();

            $record = [
                'order_increment_id' => $order->getIncrementId(),
                'comment' => $requestBody['checkoutComment']
            ];

            $this->commentModel->setData($record);
            $this->commentModel->save();
        } catch (ErrorException $e) {
            $this->logger->error($e->getMessage());
        } finally {
            return $observer;
        }
    }
}
