<?php

namespace Nasajon\NFeReader\Factory;

use \Nasajon\NFeReader\Xml;

/**
 * Notas de evento de averbação
 */
class AverbacaoNFe extends AbstractNFe{
    
    private $id;
    private $nProt;
    private $cOrgao ;
    private $chNfe;
    private $cnpj;
    private $dhEvento;
    private $descEvento;
    private $correcao;
    private $condUso;
    
    private $NFeEvento;
    
    /**
     * 
     * @param Xml $xml
     * @param float $version
     * @param string $typeName
     */
    public function __construct(Xml $xml, $version, $typeName) {
        parent::__construct($version, $typeName);
        $this->id = $xml->findAttribute('Id');
        $this->nProt = $xml->getTagValue('nProt');
        $this->cOrgao = $xml->getTagValue('cOrgao');
        $this->chNfe = $xml->getTagValue('chNFe');
        $this->cnpj = $xml->getTagValue('CNPJ');
        $this->dhEvento = $xml->getTagValue('dhEvento');
        $this->descEvento = $xml->getTagValue('descEvento');
        $this->correcao = $xml->getTagValue('xCorrecao');
        $this->condUso = $xml->getTagValue('xCondUso');
        $this->NFeEvento = $xml->toJson();
    }
    
    /**
     * 
     * @return array
     */
    public function getBasicInfo(){
        return array (
            'id' => $this->id,
            'cOrgao' => $this->cOrgao,
            'chNFe' => $this->chNfe,
            'dhEvento' => $this->dhEvento,
            'descEvento'=>$this->descEvento,
            'correcao'=>$this->correcao,
            'condUso' => $this->condUso,
            'nProt'=>$this->nProt
        );
    }
    /**
     * 
     * @return json
     */
    public function getJsonBasicInfo(){
        return json_encode(array (
            'id' => $this->id,
            'cOrgao' => $this->cOrgao,
            'chNFe' => $this->chNfe,
            'dhEvento' => $this->dhEvento,
            'descEvento'=>$this->descEvento,
            'correcao'=>$this->correcao,
            'condUso' => $this->condUso,
            'nProt'=>$this->nProt
        ));
    }
    
    /**
     * 
     * @return json
     */
    public function getJsonNFe(){
        return $this->NFeEvento;
    }
    
    /**
     * 
     * @return float
     */
    public function getVersion(){
        return $this->version;
    }
}

