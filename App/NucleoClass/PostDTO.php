<?php

/*
  ID INT NOT NULL AUTO_INCREMENT,
  TipoPost INT NOT NULL,
  Titulo VARCHAR(45) NOT NULL,
  DtCriacao DATE NOT NULL,
  HrCriacao TIME(6) NOT NULL,
  Ativo INT NOT NULL,
  CaminhoPost VARCHAR(45) NOT NULL,
 */
class PostDTO {
 
    private $Id;
    private $ANIMAL ; // objeto animal do post
    private $TipoPost;
    private $Titulo;
    private $DtCriacao;
    private $HrCriacao;
    private $Ativo;
    private $CaminhoPost;
    private $LOCALIZACAO;
    private $caminhoSalvar = __DIR__ . "/../View/Posts/"; 
    private $CaminhoLocation;
    private $Referencia;
    private $PESSOA;


        public function __construct(
                                $id = null, 
                                $ANIMAL = null,
                                $TipoPost = null,
                                $Titulo = null, 
                                $DtCriacao = null,
                                $HrCriacao = null,
                                $Ativo = true, // ja cria o objeto como ativo
                                $CaminhoPost = null,
                                $LOCALIZACAO = null
                                ,$PESSOA = null
                                ,$Referencia = null)
                          
    {
        date_default_timezone_set('America/Sao_Paulo');
        
        $this->setId($id);
        $this->setTipoPost($TipoPost);
        $this->setTitulo($Titulo); 
        $this->setDtCriacao($DtCriacao);
        $this->setHrCriacao($HrCriacao);
        $this->setAtivo($Ativo);
        $this->setCaminhoPost($CaminhoPost);
        $this->setLocalizacao($LOCALIZACAO);
        $this->setANIMAL($ANIMAL);
        $this->setPESSOA($PESSOA);
        $this->setReferencia($Referencia);
    }
    /**
     * @param type $Con conexao
     * @return type id da Post no banco
     */
    function CadastrarPost($Con)
    {
       $Id = PostDAO::salvePost($this , $Con);
       if($this->getId() == null)
       {
           $this->setId($Id);
       }
       return $Id;
    }
    
    function  gerarNomeArquivo()
    {
        date_default_timezone_set('America/Sao_Paulo'); // configurar hora

        $Titulo = ucwords($this->getTitulo()); // pegar o titulo do post e colocar tudo em minusculo
        $nomeArquivo = $Titulo . date("ymd"); // titulo + gerar data
        $nomeArquivo = str_replace(" ", "", $nomeArquivo) . rand(0, 100) . ".php"; // remover espacos 
        $this->setCaminhoPost($nomeArquivo );
       
    }
            
    function GerarPostArquivo()
    {
        if($this->getId() == null)
        {
            ErroController::erroFatal("Tentativa de criar post file sem ID !! "); 
        }
$POST_PREPARA = "<?php
            \$id_POST = '".$this->getId()."'; 
            if(file_exists('../Site/Layout/MODE_POTS.php'))
            {
                include_once '../Site/Layout/MODE_POTS.php';
            }
            else 
            {
               echo 'Mode nao encontrado';
                exit;
            }
            ?>";

         if(file_put_contents($this->caminhoSalvar .$this->getCaminhoPost() , $POST_PREPARA ))
         {
             
             $this->CaminhoLocation = $this->getCaminhoPost() ;
         }
         else
         {
             ErroController::erroFatal("Erro ao tentar criar Post");
         } 
        
    }
    
    function CaminhoLocation()
    {
        header("location: ../Posts/" . $this->CaminhoLocation );
    }
    
    function  getLocalizacao(){
        return $this->LOCALIZACAO;
    }
    
    function setLocalizacao($localizacao)
    {
        $this->LOCALIZACAO = $localizacao; 
    }

    function getId() {
        return $this->Id;
    }

    function getTipoPost() {
        return $this->TipoPost;
    }

    function getTitulo() {
        return $this->Titulo;
    }

    function getDtCriacao() {
        return $this->DtCriacao;
    }

    function getHrCriacao() {
        return $this->HrCriacao;
    }

    function getAtivo() {
        return $this->Ativo;
    }

    function getCaminhoPost() {
        return $this->CaminhoPost;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setTipoPost($TipoPost) {
        $this->TipoPost = $TipoPost;
    }

    function setTitulo($Titulo) {
        $this->Titulo = $Titulo;
    }

    function setDtCriacao($DtCriacao) {
        
        if(is_null($DtCriacao))
        {
            $this->DtCriacao = date("Y-m-d");
            return;
        }
        $this->DtCriacao = $DtCriacao;
    }

    function setHrCriacao($HrCriacao) {
         if(is_null($HrCriacao))
        {
            $this->HrCriacao = date("h:m:s");
            return;
        }
        $this->HrCriacao = $HrCriacao;
    }

    function setAtivo($Ativo) {
        $this->Ativo = $Ativo;
    }

    function setCaminhoPost($CaminhoPost) {
        $this->CaminhoPost = $CaminhoPost;
    }
    
    function getANIMAL() {
        return $this->ANIMAL;
    }

    function setANIMAL($ANIMAL) {
        $this->ANIMAL = $ANIMAL;
    }
    
    function setPessoa($PESSOA)
    {
        $this->PESSOA = $PESSOA;
    }
    
    function getPessoa()
    {
        return $this->PESSOA;
    }
    
    function getReferencia() {
        return $this->Referencia;
    }

    function setReferencia($Referencia) {
        $this->Referencia = $Referencia;
    }
}

