<?php

namespace Magecom\Learning\Api\Data;

interface ItemsInterface
{

    /**
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function getArray($limit = null, $offset= null);

    /**
     * @param array $data
     * @return $this
     */
    public function populateData($data = []);

    /**
     * @return $this
     * @throws InputException
     */
    public function validate();

    /**
     * @return array
     */
    public function getAvailableStatuses();
}