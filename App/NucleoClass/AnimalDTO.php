<?php

include_once __DIR__ . "/../Model/AnimalDAO.php";

/*
 */
class AnimalDTO {
    
    private $Id;
    private $TipoAnimal;
    /**
     * 1 = gato
     * 2 = cachorro
     */
    private $NomePet;
    private $PortePet;
    private $RacaPet;
    private $CorPet;
    private $Sexo;
    /**
     *  1 = macho 
     *  2 = femea
     */
    private $IdadePet;
    private $FotoPet;
    private $Ativo;
    private $POST; // objeto 
    private $PESSOA;// objeto 
    
    function __construct($Id = null,
                         $TipoAnimal = null,
                         $NomePet = null,
                         $PortePet = null,
                         $RacaPet = null,
                         $CorPet = null,
                         $Sexo = null,
                         $IdadePet = null,
                         $FotoPet = null,
                         $Ativo = true, // sempre criar como verdade 
                         $POST = null,
                         $PESSOA= null) 
    {
        $this->setId($Id);
        $this->setTipoAnimal($TipoAnimal);
        $this->setNomePet($NomePet);
        $this->setPortePet($PortePet);
        $this->setRacaPet($RacaPet);
        $this->setCorPet($CorPet);
        $this->setSexo($Sexo);
        $this->setIdadePet($IdadePet);
        $this->setFotoPet($FotoPet);
        $this->setAtivo($Ativo);
        $this->setPOST($POST);
        $this->setPESSOA($PESSOA);
    }
    
    /**
     * 
     * @param type $Con conexao 
     * @return type int id - id do animal do banco
     */
    function CadastrarPet($Con)
    {
       $id = AnimalDAO::SetNovoAnimal($this , $Con);
       if($this->getId() == null)
       {
           $this->setId($id);
       }
       return $this->getId();
    }
    
    function EditarAnimal($Con)
    {
        return AnimalDAO::EditarAnimal($this, $Con);
    }
            
    
    function getId() {
        return $this->Id;
    }

    function getTipoAnimal() {
        return $this->TipoAnimal;
    }

    function getNomePet() {
        return $this->NomePet;
    }

    function getPortePet() {
        return $this->PortePet;
    }

    function getRacaPet() {
        return $this->RacaPet;
    }

    function getCorPet() {
        return $this->CorPet;
    }

    function getSexo() {
        return $this->Sexo;
    }

    function getIdadePet() {
        return $this->IdadePet;
    }

    function getFotoPet() {
        return $this->FotoPet;
    }

    function getAtivo() {
        return $this->Ativo;
    }

    function getPOST() {
        return $this->POST;
    }

    function getPESSOA() {
        return $this->PESSOA;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setTipoAnimal($TipoAnimal) {
        $this->TipoAnimal = $TipoAnimal;
    }

    function setNomePet($NomePet) {
        $this->NomePet = $NomePet;
    }

    function setPortePet($PortePet) {
        $this->PortePet = $PortePet;
    }

    function setRacaPet($RacaPet) {
        $this->RacaPet = $RacaPet;
    }

    function setCorPet($CorPet) {
        $this->CorPet = $CorPet;
    }

    function setSexo($Sexo) {
        $this->Sexo = $Sexo;
    }

    function setIdadePet($IdadePet) {
        $this->IdadePet = $IdadePet;
    }

    function setFotoPet($FotoPet) {
        $this->FotoPet = $FotoPet;
    }

    function setAtivo($Ativo) {
        $this->Ativo = $Ativo;
    }

    function setPOST($POST) {
        $this->POST = $POST;
    }

    function setPESSOA($PESSOA) {
        $this->PESSOA = $PESSOA;
    }



}
