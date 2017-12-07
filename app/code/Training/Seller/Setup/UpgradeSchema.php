<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 10:58 AM
 */

namespace Training\Seller\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Training\Seller\Api\Data\SellerInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->addDescriptionField($setup);
        }
    }

    /**
     * Add description
     *
     * @param SchemaSetupInterface $setup
     * @return $this
     */
    protected function addDescriptionField($setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable(SellerInterface::TABLE_NAME),
            SellerInterface::FIELD_DESCRIPTION,
            [
                'type' => Table::TYPE_TEXT,
                'length' => null,
                'nullable' => true,
                'comment' => 'Description'
            ]
        );
        return $this;
    }
}
