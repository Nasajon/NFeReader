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
      $output->writeln("\n".'Tipo:'."\n");
      $output->writeln($nfe->getClass());
      $output->writeln("\n".'NFe Completa em json:'."\n");
      $output->writeln($nfe->getJsonNFe());
      $output->writeln("\n".'Informações básicas da NFe em json:'."\n");
      $output->writeln($nfe->getJsonBasicInfo());
      $output->writeln("\n".'Informações básicas da NFe:'."\n");
      foreach ($nfe->getBasicInfo() as $key => $info){
          if(is_array($info)){
              foreach ($info as $k => $i){
                  if(is_array($i)){
                      foreach ($i as $pk => $prodinfo){
                          $output->writeln('  '.$pk.' : '.$prodinfo."\n");
                      }
                  } else {
                      $output->writeln(' '.$k.' : '.$i."\n");
                  }
              }
          } else {
              $output->writeln($key.' : '.$info."\n");
          }
      }
  }

}
