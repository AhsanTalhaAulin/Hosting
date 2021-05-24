<?php

namespace Harriswebworks\Slider\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
         $installer->getConnection()->dropTable($installer->getTable('hww_slide'));
         $installer->getConnection()->dropTable($installer->getTable('hww_slider'));
        if (!$installer->tableExists('hww_slide')) {
            $table = $installer->getConnection()->newTable($installer->getTable('hww_slide'))
                    ->addColumn('slide_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Slide Id')
                    ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Slide Name')
                    ->addColumn('image', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Slide Image')
                    ->addColumn('mobile_image', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Slide Mobile Image')
                    ->addColumn('content', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', ['nullable' => false], 'Slide Content')
                    ->addColumn('click_url', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Click Url')
                    ->addColumn('slider_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => true], 'Slider Id')
                    ->addColumn('order', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'Slide Order')
                    ->addColumn('status', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slide Status')
                    ->setComment('Slide Table');
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex(
                $installer->getTable('hww_slide'),
                $setup->getIdxName(
                    $installer->getTable('hww_slide'),
                    ['name', 'image','mobile_image',  'content', 'click_url'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'image','mobile_image',  'content', 'click_url'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        if (!$installer->tableExists('hww_slider')) {
            $table = $installer->getConnection()->newTable($installer->getTable('hww_slider'))
                    ->addColumn('slider_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Slider Id')
                    ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Slider Name')
                    ->addColumn('page_type', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'Page Type')
                    ->addColumn('category_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'Category')
                    ->addColumn('custom_route', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Custom Route')
                    ->addColumn('cms_page_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['nullable' => false], 'CMS Page')
                    ->addColumn('slide_type', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slide Type')
                    ->addColumn('slide_style', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slide Style')
                    ->addColumn('status', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slide Status')
                    ->addColumn('slider_autoplay', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slider Autoplay')
                    ->addColumn('slider_nav', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slider Nav')
                    ->addColumn('slider_dots', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slider Dots')
                    ->addColumn('autoplayhoverpause', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slider Hover Pause')
                    ->addColumn('slider_lazyLoad', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 1, ['nullable' => false], 'Slider Lazyload')
                    ->setComment('Slider Table');
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex(
                $installer->getTable('hww_slider'),
                $setup->getIdxName(
                    $installer->getTable('hww_slider'),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
