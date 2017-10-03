<?php

namespace Magecom\Learning\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

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

        if (version_compare($context->getVersion(), '0.0.3', '<')) {
            $this->installLearningProductType($setup);
        }

        $setup->endSetup();
    }

    /**
     * @param $setup
     */
    protected function truncateItemsTable($setup)
    {
        if (!$setup->tableExists('learning_items')) {
            return;
        }

        $connection = $setup->getConnection();
        $connection->truncateTable($setup->getTable('learning_items'));
    }

    /**
     * @param $setup
     */
    protected function installLearningProductType($setup)
    {

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $fieldList = [
            'price',
            'special_price',
            'special_from_date',
            'special_to_date',
            'minimal_price',
            'cost',
            'tier_price',
            'weight',
        ];


        foreach ($fieldList as $field) {
            $applyTo = explode(
                ',',
                $eavSetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $field, 'apply_to')
            );

            if (!in_array(\Magecom\Learning\Model\Product\Type::TYPE_ID, $applyTo)) {
                $applyTo[] = \Magecom\Learning\Model\Product\Type::TYPE_ID;
                $eavSetup->updateAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    $field,
                    'apply_to',
                    implode(',', $applyTo)
                );
            }
        }
    }
}
