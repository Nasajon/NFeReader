# NFeReader
 ------------
## NFes Suportadas:

  NFe| Versões suportadas
------------ | -------------
NFe | 3.10
Averbação | 1.0

------------
## Instalação
###### Composer
```
"require": {
        [...]
        "nasajon/nfereader": "dev-master"
    },
[...]
    "repositories":[
    [...]
        {
            "type":"git",
            "url":"https://github.com/Nasajon/NFeReader"
        }
    ]
```
------------
## Como utilizar

#### Command line

Na pasta do projeto execute:
```bash
   $  php bin/console.php nasajon:nfereader <caminho/da/nota/NFe/a/ser/lida>
```
O resultado será a exibição do retorno dos três métodos principais : getJsonNFe(), getBasicInfo() e getJsonBasicInfo.

#### Dentro do projeto
 Classe: FactoryNFe

 Método : load()

 - Tipo: static
   
 - Input: string (conteúdo do arquivo)
   
 - Output: objeto
   
 - Principais métodos do objeto retornado no output:
  
       getJsonNFe()
       getBasicInfo()
       getJsonBasicInfo()
      
**Nota**: O objeto pode ser do tipo NFe ou AverbacaoNFe


------------
## Input e Outputs

#### Input

Tipo: string 

Conteúdo do arquivo a ser interpretado

#### Outputs
Possíveis objetos:
* NFe
* AverbacaoNFe

##### Principais métodos dos objetos citados acima:

###### getBasicInfo()

Tipo:array

Retorna alguns atributos interpretados da NFe (olha seção de tags interpretadas)

###### getJsonBasicInfo()

Tipo: json

Semelhante ao getBasicInfo(), porém em formato json

###### getJsonNFe()

tipo: json

Retorna todo conteúdo da nota como json. 

**Nota**: getJsonNFe() não interpreta a nota.

------------
## Tags interpretadas (retornada pelos métodos getBasicInfo() e getJsonBasicInfo())

#### NFe

* Id
* nProt
* dhEmit
* dhSaiEnt
* natOp
* infCpl
* vNF
* nNF
Dados da empresa emissora:
* xNome
* CNPJ
* xPais
* UF
* xMun
Dados do destino
* xNome
* CNPJ
* xPais
* UF
* xMun
Dados da transportadora:
* xNome
* CNPJ/CPF
Dados do produto:
* xProd
* CFOP

#### Averbação

* Id
* nProt
* cOrgao
* chNFe
* CNPJ
* dhEvento
* descEvento
* xCorrecao
* xCondUso

