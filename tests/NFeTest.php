<?php

namespace Nasajon\Tests;

use PHPUnit\Framework\TestCase;
use Nasajon\NFeReader\Factory\NFe;
use Nasajon\NFeReader\Xml;

class NFeTest extends TestCase{
  
  /**
    * 
    * 
    */
  public function getNfe() {
      $nfe = [];
      
      $nfe[] = array(
          __DIR__ . '/resources/xml/5f4d7aaf-6d67-45f7-bdd6-5eadc176d293.xml',
          '3.10',
          array (
              'id' => 'NFe33170511587984000175550010000094381985511974', 
              'dhEmi' => '2017-05-24T15:26:00-03:00' , 
              'dhSaiEnt' => '2017-05-24T15:27:00-03:00',
              'nNF' => '9438', 
              'natOp' => 'Vendas de Producao Propria ou de Terceiros', 
              'infCpl' => 'PAF-ECF MD5: 287D59D4EABB0E4D14FBB6C1CB517328; Valor pago em outras formas: R$54.49;', 
              'vNF' => '54.49', 
              'nProt' => '333170066564918', 
              'emitCompany' => array (
                  'nome' => 'POSTO SAO SEBASTIAO DO RJ LTDA',
                  'cnpj' => '11587984000175' ,
                  'pais' => 'BRASIL',
                  'uf' => 'RJ',
                  'mun' => 'RIO DE JANEIRO'
              ), 
              'destCompany' => array (
                  'nome' => 'NUTRY MAX COMERCIO DE PROD ALIMENTICIOS LTDA - ME',
                  'cnpj' => '15796122000103',
                  'pais' => 'Brasil',
                  'uf' => 'RJ',
                  'mun' => 'RIO DE JANEIRO'
              ), 
              'prod' => array(
                  0 => array(
                      'cfop'=> '5656',
                      'nome'=> 'DIESEL COMUM S500'
                    )
              ), 
              'transp' => [
                  'nome'=> null,
                  'cnpj'=> null
              ] 
          )
      );

      $nfe[] = array(
          __DIR__ . '/resources/xml/537e4b4c-f5ad-47a7-8e23-b50a4a428692.xml',
          '3.10',
          array(
            'id' => 'NFe42170113890656000179550010000133671401228051', 
            'dhEmi' => '2017-01-19T15:31:46-02:00', 
            'dhSaiEnt' => '2017-01-19T15:31:46-02:00',
            'nNF' => '13367', 
            'natOp' => 'REMESSA EM BONIFICACAO, DOACAO OU BRINDE - TRIBUTADA', 
            'infCpl' => 'Pecas nao destinadas para uso automotivo conforme protocolo 41/2008 (8413.7010, 8425.1100 e 8413.9190). Diferimento parcial do imposto. -', 
            'vNF' => '378.00', 
            'nProt' => '342170007262383', 
            'emitCompany' => array(
                'nome' => 'CLAW COMERCIAL IMP. E EXP. LTDA',
                'cnpj' => '13890656000179',
                'pais' => 'BRASIL',
                'uf' => 'SC',
                'mun' => 'JARAGUA DO SUL'
            ), 
            'destCompany' => array (
                'nome' => 'CASA DAS FECHADURAS DE NITEROI LTDA',
                'cnpj' => '30855886000116',
                'pais' => 'BRASIL',
                'uf' => 'RJ',
                'mun' => 'NITEROI'
            ), 
            'prod' => array (
                0 => array(
                    'cfop'=>'6910',
                    'nome'=> 'CAIXA DE CONTROLE MOTOBOMBA SUBMERSIVEL 3SDM117 1.0CV 110V/60HZ'
                  )
                ), 
            'transp' => array(
                'nome'=>'TNT MERCURIO CARGAS E ENCOMENDAS EXPRESSAS S/A (CAT)',
                'cnpj'=> '95591723005188'
            )
          )
      );
      $nfe[] = array(
          __DIR__ . '/resources/xml/5609b0d7-04cb-488d-b37d-0f88186fee3b.xml',
          '3.10',
          array(
            'id' => 'NFe41170204120453000102550550000339991550339991', 
            'dhEmi' => '2017-02-06T13:47:55+03:00', 
            'dhSaiEnt' => '2017-02-06T13:47:55+03:00',
            'nNF' => '33999', 
            'natOp' => 'Venda de Mercadoria', 
            'infCpl' => null,
            'vNF' => '5662.70', 
            'nProt' => '141170019432763', 
            'emitCompany' => array(
                'nome' => 'GERIS IND. COM. IMP E EXP. DE ACESS. P/ MOV EIRELI',
                'cnpj' => '04120453000102',
                'pais' => 'BRASIL',
                'uf' => 'PR',
                'mun' => 'ARAUCARIA'
            ), 
            'destCompany' => array (
                'nome' => 'ISAAC DAS FECHADURAS LTDA',
                'cnpj' => '28512192000134',
                'pais' => 'BRASIL',
                'uf' => 'RJ',
                'mun' => 'NITEROI'
            ), 
            'prod' => array (
                0 => array(
                    'cfop'=>'6403',
                    'nome'=> 'PUX CONCHA IMP 52 X 0,15cm INOX ESCOV'
                  ), 
                1 => array(
                    'cfop'=>'6401',
                    'nome'=> 'PUX CHATO 500mm INOX POL'
                  ),
                2 => array(
                    'cfop'=>'6101',
                    'nome'=> 'KIT RODIZIO PERFIL VIDRO 2M INOX POL'
                  )
            ),
            'transp' => array(
                'nome'=>'MERIDIONAL CARGAS 41-3112.4311',
                'cnpj'=> '23864838000803'
            )
          )
      );
      return $nfe;
  }
    

  /**
   * @dataProvider getNfe
   * 
   */
  public function test($xmlPath, $version, $basicInfo) {
      $xmlContent = file_get_contents($xmlPath);
      $xml = new Xml($xmlContent);
      
      $nfe = new NFe($xml, $version, 'nfe');

      $this->assertEquals($basicInfo, $nfe->getBasicInfo());

  }
  
}

