<?php

/*
 ID	int(11) Incremento Automático	 
Usuario	varchar(45)	 
Senha	varchar(45)
 */
class AcessoDTO {
    private $id;
    private $Usuario;
    private $senha;
    
    public function __construct($id = null, $Usuario = null , $senha = null) {
        $this->setId($id);
        $this->setUsuario($Usuario);
        $this->setSenha($senha);
    }

    
    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->Usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }


}
