<?php

namespace Magecom\Learning\Block\Adminhtml\Items;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magecom\Learning\Model\ResourceModel\Items\Collection
     */
    protected $itemsCollection;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magecom\Learning\Model\ResourceModel\Items\Collection $itemsCollection
     * @param array $data
     */
    public function	__construct(
        \Magento\Backend\Block\Template\Context	$context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magecom\Learning\Model\ResourceModel\Items\Collection $itemsCollection,
        array $data = []
    ) {
        $this->itemsCollection = $itemsCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Subscriptions Found'));
    }

    /**
     * Initialize the subscription collection
     * @return WidgetGrid
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->itemsCollection);

        return	parent::_prepareCollection();
    }

    /**
     * Prepare grid columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'item_id',
            [
                'header' =>	__('ID'),
                'index' => 'item_id'
            ]
        );
        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );
        $this->addColumn(
            'content',
            [
                'header' => __('Content'),
                'index'	=> 'content'
            ]
        );
        $this->addColumn(
            'url_key',
            [
                'header' => __('url key'),
                'index'	=> 'url_key'
            ]
        );
        $this->addColumn(
            'creation_time',
            [
                'header' => __('created at'),
                'index' => 'creation_time'
            ]
        );
        $this->addColumn(
            'update_time',
            [
                'header' => __('updated at'),
                'index'	=> 'update_time'
            ]
        );
        $this->addColumn(
            'status',
            [
                'header' => __('status'),
                'index'	=> 'status'
            ]
        );

        return	$this;
    }
}
