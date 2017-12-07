<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/29/17
 * Time: 3:00 PM
 */
namespace Training\Seller\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\Seller\Api\SellerRepositoryInterface;
use Training\Seller\Api\Data\SellerInterfaceFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var SellerInterfaceFactory
     */
    private $sellerModelFactory;

    /**
     * @var SellerRepositoryInterface
     */
    private $sellerRepository;

    /**
     * InstallData constructor.
     * @param SellerInterfaceFactory $sellerModelFactory
     * @param SellerRepositoryInterface $sellerRepository
     */
    public function __construct(
        SellerInterfaceFactory $sellerModelFactory,
        SellerRepositoryInterface $sellerRepository
    ) {
        $this->sellerModelFactory = $sellerModelFactory;
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $mainSeller = $this->sellerModelFactory->create()
            ->setIdentifier('main')
            ->setName('Main Seller');
        $this->sellerRepository->save($mainSeller);
    }
}
