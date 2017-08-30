<?php

namespace Nasajon\NFeReader\Entity;

class Company{
    private $nome;
    private $cnpj; 
    private $pais;
    private $uf;
    private $mun;
    
    /**
     * 
     * @param string $nome
     * @param string $cnpj
     * @param string $pais
     * @param string $uf
     * @param string $mun
     */
    public function __construct($nome, $cnpj, $pais, $uf, $mun) {
        $this->nome = $nome;
        $this->cnpj= $cnpj;
        $this->pais = $pais;
        $this->uf = $uf;
        $this->mun = $mun;
    }
    
    /**
     * Retorna as informações em array para facilitar a conversão em json
     * @return array
     */
    public function getInfo(){
        return array (
            'nome' => $this->nome,
            'cnpj' => $this->cnpj,
            'pais' => $this->pais,
            'uf' => $this->uf,
            'mun' => $this->mun,
        );
    }
}

