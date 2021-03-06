<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */

namespace Training\Seller\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Training\Seller\Api\SellerRepositoryInterface;

/**
 * GetCommand
 *
 * @author    Julien SUDRAUD <jusud@smile.fr>
 * @copyright 2017 Smile
 */
class GetCommand extends Command
{
    /**
     * Id argument
     */
    const ID_OPTION = 'id';

    /**
     * @var SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * GetCommand Constructor.
     *
     * @param SellerRepositoryInterface $sellerRepository
     * @param string|null               $name
     */
    public function __construct(
        SellerRepositoryInterface $sellerRepository,
        $name = null
    ) {
        $this->sellerRepository = $sellerRepository;
        parent::__construct($name);
    }

    /**
     * Configure the current command
     *
     * @return void
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
     * Executes the current command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return null|int null or 0 if everything went fine, or an error code
     * @throws \Exception
     * @SuppressWarnings("PMD.UnusedFormalParameter")
     */

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sellerId = $input->getOption(self::ID_OPTION);

        if (is_null($sellerId)) {
            throw new \InvalidArgumentException('Argument ' . self::ID_OPTION . ' is missing.');
        }

        $seller = $this->sellerRepository->getById((integer) $sellerId);

        $output->writeln('<info>' .  $seller->getName() . '</info>');

        return 0;
    }
}
