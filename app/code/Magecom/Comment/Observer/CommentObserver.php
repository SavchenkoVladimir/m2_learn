<?php

namespace Magecom\Comment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CommentObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Webapi\Rest\Request
     */
    protected $request;

    /**
     * CommentObserver constructor.
     * @param \Magento\Framework\Webapi\Rest\Request $request
     */
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request
    ) {
        $this->request = $request;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getOrder();
        $methods = get_class_methods($order);
        $orderIncrementId = $order->getIncrementId();
        $attributes = $order->getExtensionAttributes();

        $params = $this->request->getParams();
        $bodyParams = $this->request->getBodyParams()->checkoutComment;
        $inputData = $this->request->getRequestData();

        return $observer;
    }
}
