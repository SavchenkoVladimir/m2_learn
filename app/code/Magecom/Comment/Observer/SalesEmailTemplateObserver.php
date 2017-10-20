<?php

namespace Magecom\Comment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SalesEmailTemplateObserver implements ObserverInterface
{
    /**
     * @var \Magecom\Comment\Model\ResourceModel\Comment
     */
    protected $commentModel;

    /**
     * @var \Magecom\Comment\Model\Order\Email\OrderSender
     */
    protected $emailSender;

    /**
     * SalesEmailTemplateObserver constructor.
     * @param \Magecom\Comment\Model\Comment $commentModel
     */
    public function __construct(
        \Magecom\Comment\Model\Comment $commentModel,
        \Magecom\Comment\Model\Order\Email\Sender $emailSender
    ) {
        $this->commentModel = $commentModel;
        $this->emailSender = $emailSender;
    }

    /**
     * @param Observer $observer
     * @return Observer
     */
    public function execute(Observer $observer)
    {
        $transport = $observer->getTransport();
        $order = $transport->getOrder();
        $incrementId = $order->getData('increment_id');
        $transport['customerCheckoutComment'] = $this->commentModel->getComment($incrementId);
        $this->emailSender->send($order);
    }
}
