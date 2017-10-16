<?php

namespace Magecom\Comment\Block\Adminhtml;

class Comment extends \Magento\Sales\Block\Adminhtml\Order\AbstractOrder
{
    /**
     * @var \Magecom\Comment\Api\Data\CommentInterface
     */
    public $commentModel;

    /**
     * Comment constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param array $data
     * @param \Magecom\Comment\Api\Data\CommentInterface $commentModel
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        array $data = [],
        \Magecom\Comment\Api\Data\CommentInterface $commentModel
    )
    {
        $this->commentModel = $commentModel;
        parent::__construct($context, $registry, $adminHelper, $data);
    }

    /**
     * @return string/null
     */
    public function getCheckoutMessage()
    {
        $incrementId = $this->getOrder()->getData('increment_id');

        return $this->commentModel->getComment($incrementId);
    }
}