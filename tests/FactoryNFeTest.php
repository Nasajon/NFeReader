<?php

namespace Nasajon\Tests;

use PHPUnit\Framework\TestCase;
use Nasajon\NFeReader\Factory\FactoryNFe;
use Nasajon\NFeReader\Xml;
use ReflectionClass;

class FactoryNFeTest extends TestCase{
    public function getNfe() {
        $nfe = [];
        $nfe[] = [
            __DIR__ . '/resources/xml/5f4d7aaf-6d67-45f7-bdd6-5eadc176d293.xml',
            'nfe',
            '3.10',
            'Nasajon\NFeReader\Factory\NFe'
        ];

        $nfe[] = [
            __DIR__ . '/resources/xml/537e4b4c-f5ad-47a7-8e23-b50a4a428692.xml',
            'nfe',
            '3.10',
            'Nasajon\NFeReader\Factory\NFe'
        ];

        $nfe[] = [
            __DIR__ . '/resources/xml/5609b0d7-04cb-488d-b37d-0f88186fee3b.xml',
            'nfe',
            '3.10',
            'Nasajon\NFeReader\Factory\NFe'
        ];
        /* XMLs com formatação incorreta */
        $nfe[] = [
            __DIR__ . '/resources/xml/9da30599-7bc3-4270-8c0e-42581faea0e2.xml',
            'nfe',
            '3.10',
            'Nasajon\NFeReader\Factory\NFe'
        ];
        $nfe[] = [
            __DIR__ . '/resources/xml/e38b1ca9-f477-4ee3-b55e-6ec578132fd1.xml',
            'nfe',
            '3.10',
            'Nasajon\NFeReader\Factory\NFe'
        ];
        $nfe[] = [
            __DIR__ . '/resources/xml/ac98549e-8a5b-4e54-8d80-2a49bf7768ac.xml',
            'nfe',
            '3.10',
            'Nasajon\NFeReader\Factory\NFe'
        ];
        
        /*averbacaonfe*/
        $nfe[] = [
            __DIR__ . '/resources/xml/98817161-60be-4c9a-8ef5-596325fb6462.xml',
            'proceventonfe',
            '1.0',
            'Nasajon\NFeReader\Factory\AverbacaoNFe'
        ];
        $nfe[] = [
            __DIR__ . '/resources/xml/024b479a-4c8f-49d9-a34e-e529c066e49a.xml',
            'proceventonfe',
            '1.0',
            'Nasajon\NFeReader\Factory\AverbacaoNFe'
        ];
        return $nfe;
    }
    
    /**
     * @dataProvider getNfe
     * 
     */
    public function testNfe($xmlPath, $type, $version, $class) {
        $xmlContent = file_get_contents($xmlPath);
        
        $xml = new Xml($xmlContent);
        
        /*teste do getNFeType*/
        $factory = new FactoryNFe();
        $objReflection = new ReflectionClass($factory);
        
        $methodGetNFeType = $objReflection->getMethod('getNFeType');
        $methodGetNFeType->setAccessible(true);
        $nfeType = $methodGetNFeType->invoke(null, $xml);
        
        $this->assertEquals($type, strtolower($nfeType));
        
        /*teste do getVeriosn*/
        $methodGetNFeVersion = $objReflection->getMethod('getVersion');
        $methodGetNFeVersion->setAccessible(true);
        $nfeVersion = $methodGetNFeVersion->invoke(null, $xml, $type);
        
        $this->assertEquals($version, strtolower($nfeVersion));
        
        /*teste do load*/
        $obj = FactoryNFe::load($xmlContent);
        $this->assertEquals($class, get_class($obj));

    }
}

