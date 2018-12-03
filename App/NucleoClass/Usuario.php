<?php

include_once __DIR__ . "/PessoaDTO.php";

/*

 */
class Usuario extends PessoaDTO{
    
    
    private $TimeLogoOFf;
    private $Estado;
    
    public function __construct(
                                 $id = null
                                ,$Nome = null
                                ,$Sobrenome = null 
                                ,$Sexo = null
                                ,$DtNascimento = null
                                ,$Ativo = null
                                ,$POST = null
                                ,$TipoPessoa = 1
                                ,$Telefone = null
                                ,$Endereco = null
                                ,$Acesso = null
                                ,$ANUNCIO = null 
                                , $TimeLogoOFf = null
                                , $Estado = null) 
     {
        parent::__construct(    $id
                                ,$Nome
                                ,$Sobrenome 
                                ,$Sexo
                                ,$DtNascimento
                                ,$Ativo
                                ,$POST
                                ,$TipoPessoa
                                ,$Telefone
                                ,$Endereco
                                ,$Acesso
                                ,$ANUNCIO);

        $this->TimeLogoOFf = $TimeLogoOFf;
        $this->Estado = $Estado;
    }
    
    public function CriarPost(PostDTO $Post , $con)
    {
        PostDAO::salvePost($Post, $con);
    }
    
   //public function CadastrarUsuario($Con)
   //{
   //    parent::CadastrarUsuario($Con);
   //}
    
    
    public function getTimeLogoOFf() {
        return $this->TimeLogoOFf;
    }

    public function getEstado() {
        return $this->Estado;
    }

    public function setTimeLogoOFf($TimeLogoOFf) {
        $this->TimeLogoOFf = $TimeLogoOFf;
    }

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }


    
    
}
