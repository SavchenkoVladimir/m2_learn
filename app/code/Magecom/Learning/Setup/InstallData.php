<?php

namespace Magecom\Learning\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            [
                'title' => 'Title 1',
                'content' => 'Content 1',
                'url_key' => 'url key 1',
            ],
            [
                'title' => 'Title 2',
                'content' => 'Content 2',
                'url_key' => 'url key 2',
            ],
            [
                'title' => 'Title 3',
                'content' => 'Content 3',
                'url_key' => 'url key 3',
            ],
        ];

        foreach ($data as $row) {
            $setup->getConnection()->insertForce($setup->getTable('learning_items'), $row);
        }
    }
}
