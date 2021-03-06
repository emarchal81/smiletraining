<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Cron;

use Psr\Log\LoggerInterface;
use Training\Seller\Api\SellerRepositoryInterface;

/**
 * Cron: Logger
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
class Logger
{
    /**
     * @var SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Logger constructor.
     * @param SellerRepositoryInterface $sellerRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        SellerRepositoryInterface $sellerRepository,
        LoggerInterface           $logger
    ) {

        $this->sellerRepository = $sellerRepository;
        $this->logger = $logger;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $nbSellers = $this->sellerRepository->getList()->getTotalCount();

        $this->logger->info('Nb Sellers: '.$nbSellers);
    }
}
