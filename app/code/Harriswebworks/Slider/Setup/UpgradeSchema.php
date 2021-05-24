<?php
namespace Harriswebworks\Slider\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * UpgradeSchema
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context){
		$setup->startSetup();
		if (version_compare($context->getVersion(), '1.0.1', '<')) {
			/*$setup->getConnection()
			->addColumn(
				$setup->getTable('hww_slider'),
				'slider_setting',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'nullable' => true,
					'comment' => 'Setting slider'
				]
			);*/
		}
		if (version_compare($context->getVersion(), '1.0.2', '<')) {
			$setup->getConnection()->addColumn(
				$setup->getTable('hww_slider'),
				'slider_autoplay',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 1,
                    'nullable' => false,
                    'default' => 1,
                    'comment' => 'slider autoplay'
                ]
			);

			$setup->getConnection()->addColumn(
				$setup->getTable('hww_slider'),
				'slider_nav',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 1,
                    'nullable' => false,
                    'default' => 1,
                    'comment' => 'slider nav'
                ]
			);

			$setup->getConnection()->addColumn(
				$setup->getTable('hww_slider'),
				'slider_dots',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 1,
                    'nullable' => false,
                    'default' => 0,
                    'comment' => 'slider dots'
                ]
			);
			$setup->getConnection()->addColumn(
				$setup->getTable('hww_slider'),
				'autoplayhoverpause',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 1,
                    'nullable' => false,
                    'default' => 0,
                    'comment' => 'autoplay hover pause'
                ]
			);
			$setup->getConnection()->addColumn(
				$setup->getTable('hww_slider'),
				'slider_lazyLoad',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'length' => 1,
                    'nullable' => false,
                    'default' => 0,
                    'comment' => 'autoplay hover pause'
                ]
			);

		}
		$setup->endSetup();
	}
}
?>