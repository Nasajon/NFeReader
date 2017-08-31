<?php

namespace Nasajon\NFeReader\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Exception;

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
        if(empty($input->getArgument('nfe'))){
            throw new Exception('É preciso definir o caminho da nota a ser lida'); 
        }
        $file = $input->getArgument('nfe');
        $this->reader($file, $output);
    }

}
