<?php

namespace Magecom\Comment\Ui\Component\Listing\Column;

class Comment extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magecom\Comment\Api\Data\CommentInterface
     */
    protected $commentModel;

    /**
     * Comment constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magecom\Comment\Api\Data\CommentInterface $commentModel
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magecom\Comment\Api\Data\CommentInterface $commentModel,
        array $components = [],
        array $data = []
    ) {
        $this->commentModel = $commentModel;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['increment_id'])) {
                    $item['checkout_comment'] = $this->commentModel->getComment($item['increment_id']);
                }
            }
        }

        return $dataSource;
    }
}
