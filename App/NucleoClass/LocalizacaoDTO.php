<?php

/* 
  ID INT NOT NULL AUTO_INCREMENT,
  Cidade VARCHAR(15) NOT NULL,
  Bairro VARCHAR(30) NOT NULL,
  PontoReferencia VARCHAR(100) NULL,
  POST_ID INT NOT NULL,
  PRIMARY KEY(ID),
 */
class LocalizacaoDTO {
    private $Id;
    private $Cidade;
    private $Bairro;
    private $PontoReferencia;
    function __construct(
            $Id =null,
            $Cidade =null,
            $Bairro =null,
            $PontoReferencia =null)
            
    {
        $this->setId($Id);
        $this->setCidade($Cidade);
        $this->setBairro($Bairro);
        $this->setPontoReferencia($PontoReferencia);
    }
    
    
    function getId() {
        return $this->Id;
    }

    function getCidade() {
        return $this->Cidade;
    }

    function getBairro() {
        return $this->Bairro;
    }

    function getPontoReferencia() {
        return $this->PontoReferencia;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setCidade($Cidade) {
        $this->Cidade = $Cidade;
    }

    function setBairro($Bairro) {
        $this->Bairro = $Bairro;
    }

    function setPontoReferencia($PontoReferencia) {
        $this->PontoReferencia = $PontoReferencia;
    }


}
