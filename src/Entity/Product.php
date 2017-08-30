<?php

namespace Nasajon\NFeReader\Entity;



class Product{
    
    private $cfop;
    private $nome;
    
    /**
     * 
     * @param integer $cfop
     * @param string $nome
     */
    public function __construct($cfop, $nome) {
        $this->cfop = $cfop;
        $this->nome = $nome;
    }
    
    /**
     * 
     * @return integer
     */
    public function getCfop(){
        return $this->cfop;
    }
    
    /**
     * 
     * @return string
     */
    public function getNome(){
        return $this->nome;
    }
    
    /**
     * Retorna as informações em array para facilitar a conversão em json
     * @return array
     */
    public function getInfo(){
        return array (
            'cfop'=>$this->cfop,
            'nome'=>$this->nome
        );
    }
}

