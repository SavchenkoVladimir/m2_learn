<?php

namespace Magecom\Learning\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2', '<')) {
            $this->truncateItemsTable($setup);
        }

        $setup->endSetup();
    }

    /**
     * @param $setup
     */
    private function truncateItemsTable($setup)
    {
        if (!$setup->tableExists('learning_items')) {
            return;
        }

        $connection = $setup->getConnection();
        $connection->truncateTable($setup->getTable('learning_items'));
    }
}
