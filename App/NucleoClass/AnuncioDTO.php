<?php

/*
   ID INT NOT NULL AUTO_INCREMENT,
  DtCriacao DATE NOT NULL,
  HrCriacao TIME(6) NOT NULL,
  FotoAnuncio VARCHAR(45) NOT NULL,
  Ativo INT NOT NULL,
  Aprovado INT NOT NULL,
 */
class AnuncioDTO {   
    private static $NomeModeAnuncio = "./Layout/" . "MODE_ANUNCIO.php";
    
   private $Id;
   private $DtCriacao;
   private $HrCriacao;
   private $FotoAnuncio;
   private $Ativo;
   private $Aprovado;
   function __construct($Id = null,
                        $DtCriacao = null,
                        $HrCriacao = null, 
                        $FotoAnuncio = null, 
                        $Ativo = null,
                        $Aprovado = null) 
    {
       $this->setId($Id);
       $this->setDtCriacao($DtCriacao);
       $this->setHrCriacao($HrCriacao);
       $this->setFotoAnuncio($FotoAnuncio);
       $this->setAtivo($Ativo);
       $this->setAprovado($Aprovado);
   }
   function CadastrarAnuncio($Con){
       
      return AnuncioDAO::SalvarNovoAnuncio( $this , $Con);
       
   }
   
   function getId() {
       return $this->Id;
   }

   function getDtCriacao() {
       return $this->DtCriacao;
   }

   function getHrCriacao() {
       return $this->HrCriacao;
   }

   function getFotoAnuncio() {
       return $this->FotoAnuncio;
   }

   function getAtivo() {
       return $this->Ativo;
   }

   function getAprovado() {
       if($this->Aprovado == NULL)
            return 0;
       return $this->Aprovado;
   }

   function setId($Id) {
       $this->Id = $Id;
   }

   function setDtCriacao($DtCriacao) {
       $this->DtCriacao = $DtCriacao;
   }

   function setHrCriacao($HrCriacao) {
       $this->HrCriacao = $HrCriacao;
   }

   function setFotoAnuncio($FotoAnuncio) {
       $this->FotoAnuncio = $FotoAnuncio;
   }

   function setAtivo($Ativo) {
       $this->Ativo = $Ativo;
   }

   function setAprovado($Aprovado) {
       $this->Aprovado = $Aprovado;
   }

       
    public static function GerarAnuncio()
    {
        self::incluirModeAnuncio();
    }
    
    private static function incluirModeAnuncio()
    {
        if(file_exists(self::$NomeModeAnuncio))
        {
            include_once self::$NomeModeAnuncio;
        }
        if(file_exists("../Site/Layout/MODE_ANUNCIO.php"))
        {
            include_once "../Site/Layout/MODE_ANUNCIO.php";
        }
        
       
    }
}
