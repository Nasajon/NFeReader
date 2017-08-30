<?php

namespace Nasajon\NFeReader\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends NFeReader {

    protected function configure() {
        $this
            ->setName('nasajon:nfereader')
            ->setDescription('Leitor e interpretador de NFe')                
            ->setDefinition(array(
                     new InputArgument('nfe', InputOption::VALUE_REQUIRED, 'NFe a ser lida e interpretada.')
                ));
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $file = empty($input->getArgument('nfe'))? getcwd() : $input->getArgument('nfe');
        $this->reader($file, $output);
    }

}
