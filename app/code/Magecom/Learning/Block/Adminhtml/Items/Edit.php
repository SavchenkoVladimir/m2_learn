<?php

namespace Magecom\Learning\Block\Adminhtml\Items;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Init class
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'item_id';
        $this->_controller = 'adminhtml_items';
        $this->_blockGroup = 'Magecom_Learning';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Item'));
        $this->buttonList->update('delete', 'label', __('Delete Item'));

        $this->buttonList->add(
            'save_and_continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            10
        );
    }
}
