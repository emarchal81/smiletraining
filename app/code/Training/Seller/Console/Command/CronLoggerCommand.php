<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 4:58 PM
 */

namespace Training\Seller\Console\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Training\Seller\Cron\Logger;

class CronLoggerCommand extends Command
{
    /**
     * @var Logger
     */
    private $cronLogger;

    /**
     * CronLoggerCommand constructor.
     * @param Logger $cronLogger
     * @param null $name
     */
    public function __construct(Logger $cronLogger, $name = null)
    {
        parent::__construct($name);
        $this->cronLogger = $cronLogger;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:seller:cronlogger')
            ->setDescription('log seller_id');
        parent::configure();
    }
    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Cron Begin');
        $this->cronLogger->execute();
        $output->writeln('Cron End');
    }

}