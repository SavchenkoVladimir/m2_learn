<?php

namespace Magecom\Comment\Api;

interface EmailSenderInterface
{
    /**
     * Send letter with order data
     *
     * @param \Magento\Sales\Model\Order $order
     * @return boolean
     */
    public function send(\Magento\Sales\Model\Order $order);
}