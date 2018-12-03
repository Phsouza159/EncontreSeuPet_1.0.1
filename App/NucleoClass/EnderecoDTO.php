<?php

/*
ID	int(11) Incremento Automático	 
CEP	int(11)	 
Endereco	varchar(45)	 
Complemento	varchar(45)	 
UF	char(2)
 */
class EnderecoDTO {

   private $Id;
   private $CEP;
   private $Endereco;
   private $Complemento;
   private $UF;
   
   public function __construct($Id = null, $CEP = null , $Endereco = null, $Complemento = null, $UF = null) {
       $this->setId($Id);
       $this->setCEP($CEP);
       $this->setEndereco($Endereco);
       $this->setComplemento($Complemento);
       $this->setUF($UF);
   }
   
   public function SalvarEndereco($Con)
   {
      return EnderecoDAO::SetNovoEndereco($this, $Con);
   }
   
   public function EditarEndereco($Con)
   {
       return EnderecoDAO::EditarEndereco($this , $Con);
   }
   
   public function getId() {
       return $this->Id;
   }

   public function getCEP() {
       return $this->CEP;
   }

   public function getEndereco() {
       return $this->Endereco;
   }

   public function getComplemento() {
       return $this->Complemento;
   }

   public function getUF() {
       return $this->UF;
   }

   public function setId($Id) {
       $this->Id = $Id;
   }

   public function setCEP($CEP) {
       $this->CEP = $CEP;
   }

   public function setEndereco($Endereco) {
       $this->Endereco = $Endereco;
   }

   public function setComplemento($Complemento) {
       $this->Complemento = $Complemento;
   }

   public function setUF($UF) {
       $this->UF = $UF;
   }
  
}
