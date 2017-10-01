<?php

namespace Magecom\Learning\Model;

use Magento\Framework\Exception\InputException;

class Items extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @inheritdoc
     */
    const CACHE_TAG = 'magecom_learning_items';

    /**
     * Record status
     */
    const RECORD_STATUS_DISABLED = 0;

    /**
     * Record status
     */
    const RECORD_STATUS_ENABLED = 1;

    /**
     * Record status
     */
    const RECORD_STATUS_ARCHIVED = 2;

    /**
     * @var \Magento\Framework\Exception\InputException
     */
    protected $inputException;

    /**
     * Items constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null
    ) {

        $this->inputException = new InputException();
        parent::__construct($context, $registry, $resource, $resourceCollection);
    }

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('Magecom\Learning\Model\ResourceModel\Items');
    }

    /**
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function getArray($limit = null, $offset= null)
    {
        $collection = $this->getCollection()
            ->addFieldToSelect('item_id')
            ->addFieldToSelect('title')
            ->addFieldToSelect('creation_time');

        if ($limit) {
            $collection->setPageSize($limit);
        }

        if ($offset) {
            $collection->setCurPage($offset);
        }

        return $collection->toArray();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function populateData($data = [])
    {
        if(!empty($data['item_id'])){
            $this->load($data['item_id']);
        }

        $this->setTitle($data['title']);
        $this->setContent($data['content']);
        $this->setUrlKey($data['url_key']);
        $this->setStatus($data['status']);

        return $this;
    }

    /**
     * @return $this
     * @throws InputException
     */
    public function validate()
    {
        $stringLengthValidation = new \Zend_Validate_StringLength(['min' => 5, 'max' => 255]);

        if (!$stringLengthValidation->isValid(trim($this->getTitle()))) {
            $this->inputException->addError(__('%fieldName is a required field.', ['fieldName' => 'title']));
        }

        if (!$stringLengthValidation->isValid(trim($this->getTitle()))) {
            $this->inputException->addError(__('%fieldName is a required field.', ['fieldName' => 'content']));
        }

        if (!$stringLengthValidation->isValid(trim($this->getTitle()))) {
            $this->inputException->addError(__('%fieldName is a required field.', ['fieldName' => 'url_key']));
        }

        if (!\Zend_Validate::is(trim($this->getStatus()), 'NotEmpty')) {
            $this->inputException->addError(__('%fieldName is a required field.', ['fieldName' => 'status']));
        } elseif (!\Zend_Validate::is((integer)$this->getStatus(), 'Digits')) {
            $this->inputException->addError(__('%fieldName has to be between 0 and 2.', ['fieldName' => 'status']));
        } elseif (!\Zend_Validate::is(trim($this->getStatus()), 'Between', ['min' => 0, 'max' => 2])) {
            $this->inputException->addError(__('%fieldName has to be between 0 and 2.', ['fieldName' => 'status']));
        }

        if ($this->inputException->wasErrorAdded()) {
            throw $this->inputException;
        }

        return $this;
    }

    /**
     * Prepare item's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        $statuses = [
            self::RECORD_STATUS_ENABLED => __('Enabled'),
            self::RECORD_STATUS_DISABLED => __('Disabled'),
            self::RECORD_STATUS_ARCHIVED => __('Archive')
        ];

        return $statuses;
    }
}