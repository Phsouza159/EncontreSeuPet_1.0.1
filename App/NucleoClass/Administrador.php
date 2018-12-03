<?php

include_once __DIR__ . '/PessoaDTO.php';

class Administrador extends PessoaDTO{
    
    public function __construct($id = null
            , $Nome = null
            , $Sobrenome = null
            , $Sexo = null
            , $DtNascimento = null
            , $Ativo = null
            , $POST = null
            , $TipoPessoa = null
            , $Telefone = null
            , $Endereco = null
            , $Acesso = null
            , $ANUNCIO = null) {
        
        parent::__construct($id, $Nome, $Sobrenome, $Sexo, $DtNascimento, $Ativo, $POST, $TipoPessoa, $Telefone, $Endereco, $Acesso, $ANUNCIO);
    }
}
