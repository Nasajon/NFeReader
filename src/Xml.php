<?php

namespace Nasajon\NFeReader;

use \Nasajon\NFeReader\FileManipulation;
use \Nasajon\NFeReader\Exception\FileIsNotXMLException;

/**
 * Classe que utiliza DOMDocument e simpleXML para manipular arquivos XML
 */
class Xml {

  private $dom;
  private $content;

  /**
   * 
   * @param string $xmlContent conteudo do arquivo
   * 
   * Caso o XML esteja mal formatado, a função que corrige o XML é invocada
   */
  public function __construct($xmlContent) {
    $this->dom = new \DOMDocument('1.0', 'utf-8');
    if (self::isXml($xmlContent)) {
      $this->dom->loadXML($xmlContent, LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);
      $this->content = $xmlContent;
    } else {
      $this->content = $this->fix($xmlContent);
      if (!$this->isXml($this->content)) {
        throw new FileIsNotXMLException('Não é um xml');
      }
    }
  }

  /**
   * 
   * @param string $xmlContent conteúdo do arquivo XML
   * @return DOMDocument
   */
  public static function isXml($xmlContent) {
    if (empty($xmlContent)) {
      return false;
    }
    if (stripos($xmlContent, '<!DOCTYPE html>') !== false || stripos($xmlContent, '<html') !== false) {
      return false;
    }
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->strictErrorChecking = false;
    libxml_use_internal_errors(true);
    return $dom->loadXML($xmlContent, LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG); //
  }

  /**
   * 
   * @param string $xmlContent conteudo do arquivo
   * @return type
   */
  private function fix($xmlContent) {
    $this->dom->strictErrorChecking = false;
    libxml_use_internal_errors(true);
    $this->dom->recover = true;
    $this->dom->loadXML($xmlContent);
    $xml = $this->dom->saveXML();
    return $xml;
  }

  /**
   * 
   * @param string $tag ex: 'nPro'
   * @return string | false
   */
  public function getTagValue($tag) {
    $value = $this->dom->getElementsByTagName($tag);
    if ($value->length > 0 && !empty($value->item(0)->nodeValue)) {
      return utf8_encode($value->item(0)->nodeValue);
    }
    return null;
  }

  /**
   * Utilizado quando a tag desejada aparace mais de uma vez no documento, com valores distintos
   * @param string $tag ex: 'prod'
   * @return array | false
   */
  public function getEqualTags($tag) {
    $nodes = $this->dom->getElementsByTagName($tag);
    if ($nodes->length > 0) {
      foreach ($nodes as $node) {
        $set = array();
        $this->getChild($node, $set, null);
        $children[] = $set[$tag];
      }
      return $children;
    }
    return null;
  }

  /**
   * Utilizado quando há tags com mais de um nível de profundidade dentro da tag referenciada no parâmetro da função
   * Retorna as tags a partir da tag requisitada
   * @param string $tag
   * @return boolean
   */
  public function getChildTag($tag) {
    $value = $this->dom->getElementsByTagName($tag);
    if ($value->length > 0) {
      $children = array();
      $this->getChild($value->item(0), $children, null);
      return $children[$tag];
    }
    return null;
  }

  /**
   * 
   * @param node $tag node analisado
   * @param array $result 
   * @param node $father 
   * @return type
   */
  private function getChild($tag, & $result, $father) {
    $childNodes = $tag->childNodes;
    if (empty($childNodes)) {
      return utf8_encode($tag->nodeValue);
    }
    foreach ($childNodes as $child) {
      $result[$tag->nodeName] = $this->getChild($child, $result[$tag->nodeName], $tag->nodeName);
    }
    return $result;
  }

  /**
   * retorna o conteúdo do XML
   * @return string
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Invocado quando se deseja o valor de um atributo que pode estar em qualquer tag.
   * Para na primeira ocorrência
   * @param string $tag ex:'Id'
   * @return string ex: '1234545'
   */
  public function findAttribute($tag) {
    $value = false;
    $expression = '/' . $tag . '="(.*?)\"/';
    preg_match($expression, $this->content, $value);
    return utf8_encode($value[1]);
  }

  /**
   * Salva o conteúdo do XML em um json
   * @return json
   */
  public static function toJson($content) {
    $xmlstring = empty($content) ? $this->content : $content;
    $xml = simplexml_load_string($xmlstring);
    return json_encode($xml);
  }

  /**
   * Salva o conteúdo do XML em um array
   * @return array
   */
  public static function toArray($content) {
    $xmlstring = empty($content) ? $this->content : $content;
    $xml = simplexml_load_string($xmlstring);
    $json = json_encode($xml);
    return json_decode($json, TRUE);
  }

  /*
   * Descompacta o documento do zip e recupera o XML original
   * @param string $documentoZipado
   * @return string
   */
  public static function getXmlFromZip($documentoZipado) {
    return gzdecode(base64_decode($documentoZipado));
  }

}
