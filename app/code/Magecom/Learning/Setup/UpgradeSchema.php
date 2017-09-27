<?php

namespace	Magecom\Learning\Setup;

use	Magento\Framework\Setup\UpgradeSchemaInterface;
use	Magento\Framework\Setup\ModuleContextInterface;
use	Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2', '<')) {
            $this->addStatusColumn($setup);
        }

        $setup->endSetup();
    }

    /**
     * @param $setup
     */
    private function addStatusColumn($setup)
    {
        if (!$setup->tableExists('learning_items')) {
            return;
        }

        $column = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            'length' => 1,
            'nullable' => false,
            'comment' => 'Status',
            'default' => 0
        ];

        $connection = $setup->getConnection();
        $connection->addColumn($setup->getTable('learning_items'), 'status', $column);
    }
}
