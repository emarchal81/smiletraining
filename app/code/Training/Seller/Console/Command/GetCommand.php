<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 12/1/17
 * Time: 3:49 PM
 */

namespace Training\Seller\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Training\Seller\Api\SellerRepositoryInterface;

class GetCommand extends Command
{

    const ID_OPTION='id';
    /**
     * @var SellerRepositoryInterface
     */
    private $sellerRepository;

    /**
     * GetCommand constructor.
     * @param SellerRepositoryInterface $sellerRepository
     * @param null $name
     */
    public function __construct(SellerRepositoryInterface $sellerRepository, $name = null)
    {
        parent::__construct();
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('training:seller:get')
        ->setDescription('Display seller name')
        ->setDefinition([
            new InputOption(
                self::ID_OPTION,
                '-i',
                InputOption::VALUE_REQUIRED,
                'Seller id'
            ),

        ]);

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sellerId = $input->getOption(self::ID_OPTION);
        $seller = $this->sellerRepository->getById($sellerId);
        $output->writeln(
            'Seller name : '.$seller->getName()
        );
    }
}
