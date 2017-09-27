<?php

namespace Magecom\Learning\Block\Adminhtml;

class Items extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * @var \Magento\User\Model\ResourceModel\User
     */
    protected $itemsModel;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magecom\Learning\Model\ResourceModel\Items $itemsModel
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magecom\Learning\Model\ResourceModel\Items $itemsModel,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->itemsModel = $itemsModel;
    }

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->addData(
            [
                \Magento\Backend\Block\Widget\Container::PARAM_CONTROLLER => 'items',
                \Magento\Backend\Block\Widget\Grid\Container::PARAM_BLOCK_GROUP => 'Magecom_Learning',
                \Magento\Backend\Block\Widget\Grid\Container::PARAM_BUTTON_NEW => __('Add New Item'),
                \Magento\Backend\Block\Widget\Container::PARAM_HEADER_TEXT => __('Items'),
            ]
        );

        parent::_construct();
        $this->_addBackButton();
        $this->_addNewButton();
    }
}
