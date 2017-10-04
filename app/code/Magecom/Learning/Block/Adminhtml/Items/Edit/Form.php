<?php

namespace Magecom\Learning\Block\Adminhtml\Items\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $formKey;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {

        $this->formKey = $context->getFormKey();
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setId('itemForm');
        $this->setTitle(__('Item information'));
        $this->setUseContainer(true);
    }

    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('learning_items');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        $fieldset->addField(
            'item_id',
            'hidden',
            ['name' => 'item_id', 'value' => '', 'no_span' => true]
        );

        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('title'), 'title' => __('title'), 'required' => true]
        );

        $fieldset->addField(
            'content',
            'text',
            ['name' => 'content', 'label' => __('content'), 'title' => __('content'), 'required' => true]
        );

        $fieldset->addField(
            'url_key',
            'text',
            ['name' => 'url_key', 'label' => __('url_key'), 'title' => __('url_key'), 'required' => true]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => [ ['value' => 0, 'label' => __('Disabled')], ['value' => 1, 'label' => __('Enabled')], ['value' => 2, 'label' => __('Archive')]],
                'value' => 2

            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
