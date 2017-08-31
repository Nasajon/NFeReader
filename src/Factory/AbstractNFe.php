<?php
namespace Nasajon\NFeReader\Factory;

abstract class AbstractNFe{
    
    protected $version;
    protected $typeName;
    
    /**
     * 
     * @param float $version
     * @param string $typeName
     */
    public function __construct($version, $typeName) {
        $this->version = $version;
        $this->typeName = $typeName;
    }
    
    /**
     * 
     * @return string
     */
    public function getTypeName(){
        return $this->typeName;
    }
    
    abstract function getBasicInfo(); /*algumas informações da nota em array*/
    abstract function getJsonBasicInfo(); /*algumas informações da nota em json*/
    abstract function getJsonNFe(); /*Nota completa, sem interpretar, em json*/
}
