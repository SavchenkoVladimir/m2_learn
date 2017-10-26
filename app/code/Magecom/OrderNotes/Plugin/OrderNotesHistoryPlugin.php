<?php
/**
 *  Magecom
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magecom.net so we can send you a copy immediately.
 *
 * @category Magecom
 * @package Magecom_Module
 * @copyright Copyright (c) 2017 Magecom, Inc. (http://www.magecom.net)
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace  Magecom\OrderNotes\Plugin;

class OrderNotesHistoryPlugin
{
    /**
     * us country id
     */
    const US_COUNTRY_ID = 'US';

    /**
     * avs street and zip code match success status
     */
    const AVS_SUCCESS_STATUS = 'YY';

    /**
     * avs verification success message
     */
    const AVS_MESSAGE = ' AVS YY ';

    /**
     * billing and shipping are same message
     */
    const BILLING_AND_SHIPPING_SAME_MESSAGE = ' BS M ';

    /**
     * international order message
     */
    const INTERNATIONAL_ORDER_MESSAGE = ' IV Y ';

    /**
     * @param \Magento\Sales\Model\Order\Status\History $subject
     * @param $result
     * @return string
     */
    public function afterGetComment(\Magento\Sales\Model\Order\Status\History $subject, $result)
    {
        if (strpos($result, 'Transaction ID:')) {
            return $this->getMessage($subject->getOrder());
        }

        return $result;
    }

    /**
     * @param $order
     * @return string
     */
    protected function getMessage($order)
    {
        $shippingMatch = $this->getShippingMatchMessage($order);
        $international = $this->getIsOrderInternationalMessage($order);
        $avs = $this->getAvs($order);
        $message[] = $avs;

        if ($avs !== '' && $international !== '') {
            $message[] = ' - ';
        }

        $message[] = $international;

        if (($avs !== '' || $international !== '') && $shippingMatch !== '') {
            $message[] = ' - ';
        }

        $message[] = $shippingMatch;

        return implode($message);
    }

    /**
     * @param $order
     * @return string
     */
    protected function getAvs($order)
    {
        $payment = $order->getPayment();
        $match = $payment->getAdditionalInformation('avsaddr') . $payment->getAdditionalInformation('avszip');

        if ($match === self::AVS_SUCCESS_STATUS) {
            return self::AVS_MESSAGE;
        }

        return '';
    }

    /**
     * @param $order
     * @return string
     */
    protected function getShippingMatchMessage($order)
    {
        $billing = $order->getBillingAddress();
        $shipping = $order->getShippingAddress();

        $billingAddress = [
            'country_id' =>   $billing->getCountryId(),
            'city' => $billing->getCity(),
            'postcode' => $billing->getPostcode(),
            'region' => $billing->getRegion(),
            'street' => implode($billing->getStreet())
        ];

        $shippingAddress = [
            'country_id' =>   $shipping->getCountryId(),
            'city' => $shipping->getCity(),
            'postcode' => $shipping->getPostcode(),
            'region' => $shipping->getRegion(),
            'street' => implode($shipping->getStreet())
        ];

        if (empty(array_diff($shippingAddress, $billingAddress))) {
            return self::BILLING_AND_SHIPPING_SAME_MESSAGE;
        }

        return '';
    }

    /**
     * @param $order
     * @return string
     */
    protected function getIsOrderInternationalMessage($order)
    {
        $shippingCountryId = $order->getShippingAddress()->getCountryId();
        $billingCountryId = $order->getBillingAddress()->getCountryId();

        if ($shippingCountryId !== self::US_COUNTRY_ID && $billingCountryId !== self::US_COUNTRY_ID) {
            return self::INTERNATIONAL_ORDER_MESSAGE;
        }

        return '';
    }
}