<?php

/*
 
 */
class Patrocinador extends PessoaDTO {
   private $Anuncio;
   private $NomeEmpresa;
   private $EmailEmpresa;
   private $IdTelefone;

      function __construct(
            $id = null, 
            $Nome = null,
            $Sobrenome = null, 
            $Sexo = null,
            $DtNascimento = null,
            $Ativo = null,
            $POST = null,
            $TipoPessoa = null,
            $Telefone = null,
            $Endereco = null,
            $Acesso = null,
             $Anuncio = null
           , $NomeEmpresa = null
           , $EmailEmpresa = null
           , $IdTelefone = null)
    {
          
       parent::__construct($id , $Nome , $Sobrenome , $Sexo , $DtNascimento , $Ativo , $POST , $TipoPessoa , $Telefone ,$Endereco , $Acesso);

       $this->Ativo = $Ativo;
       $this->Anuncio = $Anuncio;
       $this->NomeEmpresa = $NomeEmpresa;
       $this->EmailEmpresa = $EmailEmpresa;
       $this->IdTelefone = $IdTelefone;
   }
   
   function CadastrarAnuncio($Con)
   {
       return AnuncioDAO::SalvarNovoAnuncio($this , $Con);
   }

   

   function getAnuncio() {
       return $this->Anuncio;
   }

   function getNomeEmpresa() {
       return $this->NomeEmpresa;
   }

   function getEmailEmpresa() {
       return $this->EmailEmpresa;
   }


   function setAnuncio($Anuncio) {
       $this->Anuncio = $Anuncio;
   }

   function setNomeEmpresa($NomeEmpresa) {
       $this->NomeEmpresa = $NomeEmpresa;
   }

   function setEmailEmpresa($EmailEmpresa) {
       $this->EmailEmpresa = $EmailEmpresa;
   }

   function getIdTelefone() {
       return $this->IdTelefone;
   }

   function setIdTelefone($IdTelefone) {
       $this->IdTelefone = $IdTelefone;
   }
   
}
