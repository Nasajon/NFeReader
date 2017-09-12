<?php
namespace Nasajon\NFeReader\Factory;

use Nasajon\NFeReader\Xml;
use Nasajon\NFeReader\Exception\NFeVersionNotSupportedException;
use Nasajon\NFeReader\Exception\NFeTypeNotSupportedException;
use Nasajon\NFeReader\Exception\FileIsNotNFeException;

class FactoryNFe{
    
    const SUPPORTEDTYPES = ['NFe','procEventoNFe']; /*averbacao internamente na NFE é referida como procEventoNFe*/
    const SUPPORTEDVERSION = [
            'nfe'=>[ 3.10 ],
            'proceventonfe' => [ 1.00 ]];
    
    /**
     * Recebe o conteudo do arquivo, verifica a versão, o tipo e passa seu respectivo XML para a classe capacitada
     * @param string $xmlContent conteudo do arquivo
     * @throws \Exception
     */
    public static function load($xmlContent){
        $xml = new Xml($xmlContent); 
        $nftype = self::getNFeType($xml); 
        if($nftype){
            $nftype = strtolower($nftype);
            $version =self::getVersion($xml, $nftype);
            if(!$version){
                throw new NFeVersionNotSupportedException($nftype.'('.$version.') não suportado');
            }
            switch ($nftype){
                case 'nfe':
                    return self::loadNFeVersion($xml, $version, $nftype);
                case 'proceventonfe':
                    return self::loadNFeEventoVersion($xml,$version, $nftype);
            }            
        } else if (empty ($nftype)){
            throw new FileIsNotNFeException('O arquivo não é uma NFe\n');
        } else {
            throw new NFeTypeNotSupportedException('A NFe ['.$nftype.'] é um formato não suportado');
        }
    }
    
    /**
     * 
     * @param Xml $xml 
     * @param float $version
     * @param string $nftype
     * @return \Nasajon\NFeReader\Factory\NFe
     */
    private static function loadNFeVersion($xml, $version, $nftype){
        switch ($version){
            case 3.10:
                $nfe = new NFe($xml, $version, $nftype);
                return $nfe;
        }
    }
    
    /**
     * 
     * @param Xml $xml
     * @param float $version
     * @param string $nftype
     * @return \Nasajon\NFeReader\Factory\EventoNFe
     */
    private static function loadNFeEventoVersion($xml, $version, $nftype){
        switch ($version){
            case 1.0:
                $nfe = new EventoNFe($xml, $version, $nftype);
                return $nfe;
        }
    }

    /**
     * Retorna o tipo de NFe, caso suportada
     * @param Xml $xml 
     * @return string | false
     */
    private static function getNFeType($xml){
        foreach (self::SUPPORTEDTYPES as $supportednf){ 
            if($xml->getTagValue($supportednf)){
                return $supportednf;
            }
        }
        return false;
    }
    
    /**
     * Retorna a versão da NFe, caso seja suportada
     * @param Xml $xml
     * @param string $NFeType tipo da NFe
     * @return string
     */
    private static function getVersion($xml, $NFeType){
        $version = (float) $xml->findAttribute('versao');
        if(in_array($version, self::SUPPORTEDVERSION[strtolower($NFeType)])){
            return $version;
        }  
        return false;
    }
    
}

