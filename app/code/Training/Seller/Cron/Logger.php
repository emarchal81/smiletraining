<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 4:46 PM
 */

namespace Training\Seller\Cron;

use Psr\Log\LoggerInterface;

class Logger
{
    /**
    * @var LoggerInterface
    */
    protected $logger;

    /**
     * PredispatchLogUrl constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('test');
    }
}
