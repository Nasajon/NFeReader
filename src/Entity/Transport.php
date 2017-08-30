<?php

namespace Nasajon\NFeReader\Entity;

/**
 *  
 */
class Transport{
    
    private $cnpjCpf;
    private $nome;
    
    /**
     * 
     * @param string $cnpjCpf
     * @param string $nome
     */
    public function __construct($cnpjCpf, $nome) {
        $this->nome = $nome;
        $this->cnpjCpf = $cnpjCpf;
    }
    
    /**
     * Retorna as informações em array para facilitar a conversão em json
     * @return array
     */
    public function getInfo(){
        return array (
            'nome' => $this->nome,
            'cnpj' => $this->cnpjCpf
        );
    }
}

