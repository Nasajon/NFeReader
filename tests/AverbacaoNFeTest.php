<?php

namespace Nasajon\Tests;

use PHPUnit\Framework\TestCase;
use Nasajon\NFeReader\Factory\AverbacaoNFe;
use Nasajon\NFeReader\Xml;

class AverbacaoNFeTest extends TestCase{
  
  /**
    * 
    * 
    */
  public function getAverbacaoNfe() {
      $averbacaoNFe = [];
      
      $averbacaoNFe[] = array(
          __DIR__ . '/resources/xml/98817161-60be-4c9a-8ef5-596325fb6462.xml',
          '3.10',
          array (
              'id' => 'ID1101113317012522796500014255001000000049123612871801',
              'cOrgao' => '33',
              'chNFe' => '33170125227965000142550010000000491236128718',
              'dhEvento' => '2017-01-13T11:37:11-03:00',
              'descEvento'=>'Cancelamento',
              'correcao'=> null,
              'condUso' => null,
              'nProt'=> '333170005766106'
          )
      );
      $averbacaoNFe[] = array(
          __DIR__ . '/resources/xml/024b479a-4c8f-49d9-a34e-e529c066e49a.xml',
          '3.10',
          array (
              'id' => 'ID1101105116121735647400017355001000070549183301842201',
              'cOrgao' => '51' ,
              'chNFe' => '51161217356474000173550010000705491833018422',
              'dhEvento' => '2016-12-20T15:16:07-03:00',
              'descEvento'=> 'Carta de Correcao',
              'correcao'=> 'ALTERA-SE OS SEGUINTES DADOS- TRANSPORTADOR -RAZAO SOCIAL: LOGISTICA TRANSPORTE GOLD EIRELI MECNPJ: 21.757.921/0001-73 | INS. ESTADUAL: 135694817ENDERECO: AVENIDA DESEMBARGADOR ANTONIO QUIRINO DE ARAUJO, 1387 ACIDADE: CUIABA-MT | CEP: 78.015-580PLACA VEICULO: KAQ 3834/MT- DADOS ADICIONAIS - MOTORISTA: VALDOMIRO JACQUES DO NASCIMENTO | CPF: 780.320.671-91',
              'condUso' => 'A Carta de Correcao e disciplinada pelo paragrafo 1o-A do art. 7o do Convenio S/N, de 15 de dezembro de 1970 e pode ser utilizada para regularizacao de erro ocorrido na emissao de documento fiscal, desde que o erro nao esteja relacionado com: I - as variaveis que determinam o valor do imposto tais como: base de calculo, aliquota, diferenca de preco, quantidade, valor da operacao ou da prestacao; II - a correcao de dados cadastrais que implique mudanca do remetente ou do destinatario; III - a data de emissao ou de saida.',
              'nProt'=> '151160068862027'
          )
      );

      
      return $averbacaoNFe;
  }
    

  /**
   * @dataProvider getAverbacaoNFe
   * 
   */
  public function test($xmlPath, $version, $basicInfo) {
      $xmlContent = file_get_contents($xmlPath);
      $xml = new Xml($xmlContent);
      
      $nfe = new AverbacaoNFe($xml, $version, 'proceventonfe');

      $this->assertEquals($basicInfo, $nfe->getBasicInfo());

  }
  
}

