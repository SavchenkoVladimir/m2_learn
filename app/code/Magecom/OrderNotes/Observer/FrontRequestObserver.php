<?php
/**
 * Magecom
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
 * @package Magecom_ShippingRule
 * @copyright Copyright (c) ${YEAR} Magecom, Inc. (http://www.magecom.net)
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magecom\OrderNotes\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FrontRequestObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Session\SessionManagerInterface
     */
    protected $session;

    /**
     * FrontRequestObserver constructor.
     * @param \Magento\Framework\Session\SessionManagerInterface $session
     */
    public function __construct(
        \Magento\Framework\Session\SessionManagerInterface $session
    )
    {
        $this->session = $session;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $saleashareReferrer = $observer->getRequest()->getParam('sas', false);

        if ($saleashareReferrer) {
            $this->session->setSaleashare($saleashareReferrer);
        }
    }
}
