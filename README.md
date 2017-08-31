# NFeReader
 ------------
## NFes Suportadas:

  NFe| Versões suportadas
------------ | -------------
NFe | 3.10
Averbação | 1.0

------------
## Instalação
------------
## Como utilizar

#### Command line

Na pasta do projeto execute:
```bash
   $  php bin/console.php nasajon:nfereader <caminho da nota NFe a ser lida>
```
O resultado sera a exibição do retorno dos três métodos principais : getJsonNFe(), getBasicInfo() e getJsonBasicInfo.

#### Dentro do projeto
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
## input e Outputs

#### Input

Tipo: string 

Conteúdo do arquivo a ser interpretado

#### Outputs

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

