<?php

namespace App\Command;

use App\Service\ImportService;
use Symfony\Component\Console\Command\Command as Cmd;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Importer extends Cmd
{
    public function __construct(
        private readonly ImportService $importService
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('import:carrier:point')
            ->setDescription('Import carrier points from xml')
            ->addArgument('carrier',InputArgument::REQUIRED,'Name of carrier');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->importService->import($input->getArgument('carrier'));

        if ($result === false) {
            return Cmd::FAILURE;
        }

        return Cmd::SUCCESS;
    }
}