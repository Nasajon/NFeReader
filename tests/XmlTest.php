<?php

namespace Nasajon\Tests;

use PHPUnit\Framework\TestCase;
use Nasajon\NFeReader\Xml;


class XMLTest extends TestCase {

    /**
     * 
     * 
     */
    public function getNfe() {
        $nfe = [];
        $nfe[] = [
            __DIR__ . '/resources/xml/5f4d7aaf-6d67-45f7-bdd6-5eadc176d293.xml',
            true,
            'nfe',
            '3.10',
            'NFe33170511587984000175550010000094381985511974',
            '9438',
            '33170511587984000175550010000094381985511974',
            'RJ',
            '11587984000175'
        ];

        $nfe[] = [
            __DIR__ . '/resources/xml/537e4b4c-f5ad-47a7-8e23-b50a4a428692.xml',
            true,
            'nfe',
            '3.10',
            'NFe42170113890656000179550010000133671401228051',
            '13367',
            '42170113890656000179550010000133671401228051',
            'SC',
            '13890656000179'
        ];

        $nfe[] = [
            __DIR__ . '/resources/xml/5609b0d7-04cb-488d-b37d-0f88186fee3b.xml',
            true,
            'nfe',
            '3.10',
            'NFe41170204120453000102550550000339991550339991',
            '33999',
            '41170204120453000102550550000339991550339991',
            'PR',
            '04120453000102'
        ];
        /* XMLs com formatação incorreta */
        $nfe[] = [
            __DIR__ . '/resources/xml/9da30599-7bc3-4270-8c0e-42581faea0e2.xml',
            false,
            'nfe',
            '3.10',
            'NFe41170178900511000742550010003184861000001760',
            '318486',
            '41170178900511000742550010003184861000001760',
            'PR',
            '78900511000742'
        ];
        $nfe[] = [
            __DIR__ . '/resources/xml/e38b1ca9-f477-4ee3-b55e-6ec578132fd1.xml',
            false,
            'nfe',
            '3.10',
            'NFe33170100074569004431550010033234781116532223',
            '3323478',
            '33170100074569004431550010033234781116532223',
            'RJ',
            '00074569004431'
        ];
        $nfe[] = [
            __DIR__ . '/resources/xml/ac98549e-8a5b-4e54-8d80-2a49bf7768ac.xml',
            false,
            'nfe',
            '3.10',
            'NFe33170100074569004431550010033378711117756861',
            '3337871',
            '33170100074569004431550010033378711117756861',
            'RJ',
            '00074569004431'
        ];
        
        /*eventonfe*/
        $nfe[] = [
            __DIR__ . '/resources/xml/98817161-60be-4c9a-8ef5-596325fb6462.xml',
            true,
            'eventonfe',
            '1.0',
            'ID1101113317012522796500014255001000000049123612871801',
            false,
            '33170125227965000142550010000000491236128718',
            false, 
            false
        ];
        $nfe[] = [
            __DIR__ . '/resources/xml/024b479a-4c8f-49d9-a34e-e529c066e49a.xml',
            true,
            'eventonfe',
            '1.0',
            'ID1101105116121735647400017355001000070549183301842201',
            false,
            '51161217356474000173550010000705491833018422',
            false,
            false
        ];
        return $nfe;
    }
    
    /**
     * 
     * @dataProvider getInvalidNfe
     */
    public function getInvalidNfe() {
        $invalidNfe = [];
        $invalidNfe[] = [
            __DIR__ . '/resources/xml/00000.txt'
        ];
        $invalidNfe[] = [
            __DIR__ . '/resources/xml/01.html'
        ];

       
        return $invalidNfe;
    }
    
    /**
     * @dataProvider getNfe
     * 
     */
    public function test($xmlPath, $isXml, $type, $versao, $id, $nNF,$chNFe, $uf, $cnpj) {
        $xmlContent = file_get_contents($xmlPath);
        $xml = new Xml($xmlContent);
        
        $this->assertEquals($isXml, $xml->isXml($xmlContent));
        
        $this->assertEquals($id, $xml->findAttribute('Id'));
        $this->assertEquals($versao, $xml->findAttribute('versao'));
        $this->assertEquals($nNF, $xml->getTagValue('nNF'));
        $this->assertEquals($chNFe, $xml->getTagValue('chNFe'));
        $this->assertEquals($uf, $xml->getChildTag('emit')['UF']);
        $this->assertEquals($cnpj, $xml->getChildTag('emit')['CNPJ']);
        
    }
    /**
     * @dataProvider getInvalidNfe
     * 
     */
    public function testInvalidNfe($xmlPath) {
        $xmlContent = file_get_contents($xmlPath);
        $this->assertEquals(false, Xml::isXml($xmlContent));
    }
}
