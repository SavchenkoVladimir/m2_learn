<?php

namespace	Magecom\Learning\Setup;

use	Magento\Framework\Setup\UpgradeSchemaInterface;
use	Magento\Framework\Setup\ModuleContextInterface;
use	Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.2', '<') && $setup->tableExists('learning_items')) {
            $this->addStatusColumn($setup);
        }
        $setup->endSetup();
    }

    private function addStatusColumn($setup)
    {
        $connection = $setup->getConnection();

        $column = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            'length' => 1,
            'nullable' => false,
            'comment' => 'Status',
            'default' => 0
        ];

        $connection->addColumn($setup->getTable('learning_items'), 'status', $column);
    }
}
