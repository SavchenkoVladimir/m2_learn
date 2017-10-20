<?php

namespace Magecom\Comment\Model\Order\Email;

use Magento\Sales\Model\Order;

class Sender
{
    /**
     * Email template id
     */
    const EMAIL_TEMPLATE_ID = 'magecom_comment_order_checkout_comment_admin_template';

    /**
     * admin user id
     */
    const ADMIN_USER_ID = 1;

    /**
     * @var Order\Email\Container\OrderIdentity
     */
    protected $identityContainer;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var Order\Email\Container\Template
     */
    protected $templateContainer;

    /**
     * @var \Magento\Payment\Helper\Data
     */
    protected $paymentHelper;

    /**
     * @var Order\Address\Renderer
     */
    protected $addressRenderer;

    /**
     * @var Order\Email\SenderBuilderFactory
     */
    protected $senderBuilderFactory;

    /**
     * @var \Magecom\Comment\Model\Comment
     */
    protected $commentModel;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\User\Api\Data\UserInterface
     */
    protected $user;

    /**
     * Sender constructor.
     * @param Order\Email\Container\Template $templateContainer
     * @param Order\Email\Container\OrderIdentity $identityContainer
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Payment\Helper\Data $paymentHelper
     * @param Order\Address\Renderer $addressRenderer
     * @param Order\Email\SenderBuilderFactory $senderBuilderFactory
     * @param \Magecom\Comment\Model\Comment $commentModel
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\User\Api\Data\UserInterface $user
     */
    public function __construct(
        \Magento\Sales\Model\Order\Email\Container\Template $templateContainer,
        \Magento\Sales\Model\Order\Email\Container\OrderIdentity $identityContainer,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Payment\Helper\Data $paymentHelper,
        \Magento\Sales\Model\Order\Address\Renderer $addressRenderer,
        \Magento\Sales\Model\Order\Email\SenderBuilderFactory $senderBuilderFactory,
        \Magecom\Comment\Model\Comment $commentModel,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\User\Api\Data\UserInterface $user
    ) {
        $this->templateContainer = $templateContainer;
        $this->identityContainer = $identityContainer;
        $this->logger = $logger;
        $this->paymentHelper = $paymentHelper;
        $this->addressRenderer = $addressRenderer;
        $this->senderBuilderFactory = $senderBuilderFactory;
        $this->commentModel = $commentModel;
        $this->urlBuilder = $urlBuilder;
        $this->user = $user;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function send(Order $order)
    {
        $order->setSendEmail(true);

        if ($this->checkAndSend($order)) {
            $order->setEmailSent(true);
            return true;
        }

        return false;
    }

    protected function checkAndSend(Order $order)
    {
        $this->identityContainer->setStore($order->getStore());
        $this->prepareTemplate($order);
        $sender = $this->getSender();

        try {
            $sender->send();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return true;
    }

    /**
     * @param Order $order
     * @return void
     */
    protected function prepareTemplate(Order $order)
    {
        $transport = [
            'order' => $order,
            'billing' => $order->getBillingAddress(),
            'payment_html' => $this->getPaymentHtml($order),
            'store' => $order->getStore(),
            'formattedShippingAddress' => $this->getFormattedShippingAddress($order),
            'formattedBillingAddress' => $this->getFormattedBillingAddress($order),
            'customerCheckoutComment' => $this->commentModel->getComment($order->getData('increment_id')),
            'orderLink' => $this->getOrderLink($order)
        ];
        $transport = new \Magento\Framework\DataObject($transport);
        $this->templateContainer->setTemplateVars($transport->getData());
        $this->templateContainer->setTemplateOptions($this->getTemplateOptions());

        $this->identityContainer->setCustomerName($this->getAdminName());
        $this->identityContainer->setCustomerEmail($this->getAdminEmail());
        $this->templateContainer->setTemplateId(self::EMAIL_TEMPLATE_ID);
    }

    /**
     * @param Order $order
     * @return string
     */
    protected function getPaymentHtml(Order $order)
    {
        return $this->paymentHelper->getInfoBlockHtml(
            $order->getPayment(),
            $this->identityContainer->getStore()->getStoreId()
        );
    }

    /**
     * @param Order $order
     * @return string|null
     */
    protected function getFormattedShippingAddress($order)
    {
        return $order->getIsVirtual()
            ? null
            : $this->addressRenderer->format($order->getShippingAddress(), 'html');
    }

    /**
     * @param Order $order
     * @return string|null
     */
    protected function getFormattedBillingAddress($order)
    {
        return $this->addressRenderer->format($order->getBillingAddress(), 'html');
    }

    /**
     * @return array
     */
    protected function getTemplateOptions()
    {
        return [
            'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
            'store' => $this->identityContainer->getStore()->getStoreId()
        ];
    }

    /**
     * @return Sender
     */
    protected function getSender()
    {
        return $this->senderBuilderFactory->create(
            [
                'templateContainer' => $this->templateContainer,
                'identityContainer' => $this->identityContainer,
            ]
        );
    }

    /**
     * @return string
     */
    protected function getAdminEmail()
    {
        $this->user->load(self::ADMIN_USER_ID);

        return $this->user->getEmail();
    }

    /**
     * @param $order
     * @return string
     */
    protected function getOrderLink($order)
    {
        return $this->urlBuilder->getUrl('admin/sales/order/view/order_id' . $order->getId() . '/');
    }
}
