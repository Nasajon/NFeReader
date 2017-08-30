# NFeReader
 ------------
## NFes Suportadas:
  NFe| Verses suportadas
------------ | -------------
NFe | 3.10
Averbação | 1.0

------------
## Instalação
------------
## Como utilizar
#### Command line
#### Dentro do projeto

------------
## input e Outputs
####Input
Tipo: string 
Conteúdo do arquivo a ser interpretado
####Outputs
###### getBrief()
Tipo:array
Retorna alguns atributos interpretados da NFe (olha seção ...)
###### getJsonBrief()
Tipo: json
Semelhante ao getBrief porém em formalto json
###### getJsonNFe()
tipo: json
Retorna todo conteúdo da nota como json. 
**Nota**: getJsonNFe() não interpreta a nota.

------------
## Tags utilizadas na geração dos métodos getBrief() e getJsonBrief()
####NFe
* Id
* nProt
* dhEmit
* dhSaiEnt
* natOp
* infCpl
* vNF
* nNF
* <...>
####Averbação
* Id
* nProt
* cOrgao
* chNFe
* CNPJ
* dhEvento
* descEvento
* xCorrecao
* xCondUso

