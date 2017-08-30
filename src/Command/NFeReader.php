<?php

namespace Nasajon\NFeReader\Command;

use \Nasajon\NFeReader\Exception\FileIsNotXMLException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Nasajon\NFeReader\Xml;

class NFeReader extends Command {

  /**
   * 
   * @param string $file
   * @param OutputInterface $output
   * @throws FileIsNotXMLException
   */
  public function reader($file, OutputInterface $output) {
    
    if(Xml::isXml(file_get_contents($file))){
        $xmlContent = file_get_contents($file);
        $nfe = \Nasajon\NFeReader\Factory\FactoryNFe::load($xmlContent);
    } else {
        throw new FileIsNotXMLException($file.' não é um XML');
    }
    
    $output->writeln($nfe->getJsonNFe());
    $output->writeln($nfe->getInfo());
  }

}
