<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 11:47 AM
 */

namespace Training\Seller\Setup;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Training\Seller\Option\Seller;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;
    /**
     * @var Config
     */
    private $eavConfig;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * UpgradeData constructor.
     * @param Config $eavConfig
     * @param CustomerSetupFactory $customerSetupFactory
     * @param EavSetupFactory $eavSetupFactory
     * @internal param CustomerSetup $customerSetup
     */
    public function __construct(
        Config $eavConfig,
        CustomerSetupFactory $customerSetupFactory,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $this->addCustomerAttribute($setup);
        }

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $this->addProductAttribute($setup);
        }
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function addCustomerAttribute(ModuleDataSetupInterface $setup)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(
            Customer::ENTITY,
            'training_seller_id',
            [
                 'label'  => 'Training Seller',
                 'type'   => 'int',
                 'input'  => 'select',
                 'source' => Seller::class,
                 'required'=>false,
                 'system'   => false,
                 'position' => 900,
            ]
        );

        $this->eavConfig->clear();

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'training_seller_id');
        $attribute->setData('used_in_forms', ['adminhtml_customer']);
        $attribute->save();

        $this->eavConfig->clear();
    }

    /**
     * @param ModuleDataSetupInterface $setup
     */
    protected function addProductAttribute(ModuleDataSetupInterface $setup)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup= $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'training_seller_ids',
            [
                'label'                    => 'Training Sellers',
                'type'                     => 'text',
                'input'                    => 'multiselect',
                'backend'                  => ArrayBackend::class,
                'frontend'                 => '',
                'class'                    => '',
                'source'                   => Seller::class,
                'global'                   => Attribute::SCOPE_GLOBAL,
                'visible'                  => true,
                'required'                 => false,
                'user_defined'             => true,
                'default'                  => '',
                'searchable'               => false,
                'filterable'               => false,
                'comparable'               => true,
                'visible_on_front'         => true,
                'used_in_product_listing'  => false,
                'is_html_allowed_on_front' => true,
                'unique'                   => false,
                'apply_to'                 => 'simple,configurable'
            ]
        );

        $eavSetup->addAttributeGroup(
            Product::ENTITY,
            'bag',
            'Training'
        );

        $eavSetup->addAttributeToGroup(
            Product::ENTITY,
            'bag',
            'Training',
            'training_seller_ids'
        );

        $this->eavConfig->clear();
    }
}
