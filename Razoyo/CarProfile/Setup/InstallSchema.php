<?php
namespace Razoyo\CarProfile\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('razoyo_carprofile')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('razoyo_carprofile')
            )
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true],
                    'Entity ID'
                )
                ->addColumn(
                    'customer_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Customer ID'
                )
                ->addColumn(
                    'car_id',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Car ID'
                )
                ->addColumn(
                    'year',
                    Table::TYPE_TEXT,
                    4,
                    ['nullable' => false],
                    'Year'
                )
                ->addColumn(
                    'make',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Make'
                )
                ->addColumn(
                    'model',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Model'
                )
                ->addColumn(
                    'price',
                    Table::TYPE_FLOAT,
                    ['nullable' => true]
                )
                ->addColumn(
                    'seats',
                    Table::TYPE_INTEGER,
                    10,
                    ['nullable' => true]
                )
                ->addColumn(
                    'mpg',
                    Table::TYPE_INTEGER,
                    10,
                    ['nullable' => true]
                )

                ->addColumn(
                    'image',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'Image'
                )
                ->setComment('Car Profile Table');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
