<?php
namespace Nasajon\NFeReader\Factory;

use \Nasajon\NFeReader\Xml;
use \Nasajon\NFeReader\Entity\Company;
use \Nasajon\NFeReader\Entity\Product;
use \Nasajon\NFeReader\Entity\Transport;

class NFe extends AbstractNFe{
    
    private $id; //chave
    private $nProt; // protocolo
    private $dhEmi; //Data e hora da emissão
    private $dhSaiEnt; //Data e hora de saída e entrada da mercadoria 
    private $nNF; //numero do documento
    private $natOp; //natureza da alicação
    private $infCpl; // Informações complementares 
    private $vNF; // valor total da nota
    
    private $emitCompany; //empresa que está emitindo
    private $destCompany; //empresa que está recebendo
    private $prod; //produtos
    private $transp; //transportadora
    
    private $nfe; //json da nota original


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
        $this->dhEmi = $xml->getTagValue('dhEmi');
        $this->dhSaiEnt = $xml->getTagValue('dhSaiEnt');
        $this->natOp = $xml->getTagValue('natOp');
        $this->infCpl = $xml->getTagValue('infCpl');
        $this->vNF = $xml->getTagValue('vNF');
        $this->nNF = $xml->getTagValue('nNF');
        $emit = $xml->getChildTag('emit'); 
        $emitPais = isset($emit['xPais'])?$emit['xPais']:null;
        $this->emitCompany = new Company($emit['xNome'], $emit['CNPJ'], $emitPais, $emit['UF'], $emit['xMun']);
        $dest = $xml->getChildTag('dest');
        $destPais = isset($dest['xPais'])?$dest['xPais']:null;
        $this->destCompany = new Company($dest['xNome'], $dest['CNPJ'], $destPais, $dest['UF'], $dest['xMun']);
        $this->prod = null;
        $transp = $xml->getChildTag('transporta');
        $transpId = isset($transp['CNPJ'])?$transp['CNPJ']: (isset($transp['CPF'])?$transp['CPF']: null);
        $transpNome = isset($transp['xNome'])?$transp['xNome']: null;
        $this->transp = new Transport($transpId, $transpNome);
        $products =  $xml->getEqualTags('prod');
        $this->prod = array ();
        foreach ($products as $p)
        {
            array_push($this->prod, new Product($p['CFOP'], $p['xProd']));
        }
        $this->nfe = $xml->toJson();
    }
    
    /**
     * 
     * @return array
     */
    private function getProductsInfo(){
        $prod = array();
        foreach ($this->prod as $p){
           array_push($prod, $p->getInfo());
        }
        return $prod;
    }
    
    /**
     * 
     * @return array
     */
    public function getBasicInfo(){
        return array (
            'id' => $this->id, 
            'dhEmi' =>  $this->dhEmi, 
            'dhSaiEnt' => $this->dhSaiEnt,
            'nNF' => $this->nNF, 
            'natOp' => $this->natOp, 
            'infCpl' => $this->infCpl, 
            'vNF' => $this->vNF, 
            'nProt' => $this->nProt, 
            'emitCompany' => $this->emitCompany->getInfo(), 
            'destCompany' => $this->destCompany->getInfo(), 
            'prod' => $this->getProductsInfo(), 
            'transp' => $this->transp->getInfo() 
        );
    }
    
    /**
     * 
     * @return json
     */
    public function getJsonBasicInfo(){
        return json_encode (array (
            'id' => $this->id, 
            'dhEmi' =>  $this->dhEmi, 
            'dhSaiEnt' => $this->dhSaiEnt,
            'nNF' => $this->nNF, 
            'natOp' => $this->natOp, 
            'infCpl' => $this->infCpl, 
            'vNF' => $this->vNF, 
            'nProt' => $this->nProt, 
            'emitCompany' => $this->emitCompany->getInfo(), 
            'destCompany' => $this->destCompany->getInfo(), 
            'prod' => $this->getProductsInfo(), 
            'transp' => $this->transp->getInfo() 
        ));
    }
    
    /**
     * 
     * @return json
     */
    public function getJsonNFe(){
        return $this->nfe;
    }
    
    /**
     * 
     * @return float
     */
    public function getVersion(){
        return $this->version;
    }
    
    
}