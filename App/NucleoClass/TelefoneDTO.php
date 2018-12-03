<?php

/*
ID	int(11) Incremento Automático	 
Ddd	int(11)	 
Numero	int(11)
 */
class TelefoneDTO {
    private $Id;
    private $Ddd;
    private $Numero;
    
    public function __construct($Id = null, $Ddd = null, $Numero = null) {
        $this->setId($Id);
        $this->setDdd($Ddd);
        $this->setNumero($Numero);
    }

    
    public function CadastrarTelefone($Con)
    {
        return TelefoneDAO::SalvarNovoTelefone($this, $Con);
    }
    
    public function EditarTelefone($Con)
    {
        return TelefoneDAO::EditarTelefone($this, $Con);
    }
    
    public function getId() {
        return $this->Id;
    }

    public function getDdd() {
        return $this->Ddd;
    }

    public function getNumero() {
        return $this->Numero;
    }

    public function setId($Id) {
        $this->Id = $Id;
    }

    public function setDdd($Ddd) {
        $this->Ddd = $Ddd;
    }

    public function setNumero($Numero) {
        $this->Numero = $Numero;
    }


    
    
    
}
