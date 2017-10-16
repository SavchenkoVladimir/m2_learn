<?php

namespace Magecom\Comment\Api\Data;

interface CommentInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**
     * @param $incrementId string
     * @return mixed
     */
    public function getComment($incrementId);

    /**
     * @return mixed
     */
    public function getExtensionAttributes();

    /**
     * @param CommentExtensionInterface $extensionAttributes
     * @return mixed
     */
    public function setExtensionAttributes(
        \Magecom\Comment\Api\Data\CommentExtensionInterface $extensionAttributes
    );
}