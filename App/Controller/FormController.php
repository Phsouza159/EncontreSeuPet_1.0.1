<?php
$RETORNO = '';
 /*Controla os formularios esse arquivo*/  
 /*DIR: caminho fisico do arquivo*/  
include_once __DIR__ . "/ErroController.php";
include_once __DIR__ . "/SessionController.php";

include_once __DIR__ . "/../Model/Conexao.php";
include_once __DIR__ . "/../Model/TelefoneDAO.php";
include_once __DIR__ . "/../Model/PessoaDAO.php";
include_once __DIR__ . "/../Model/EnderecoDAO.php";
include_once __DIR__ . "/../Model/AcessoDAO.php";
include_once __DIR__ . "/../Model/AdminDAO.php";
include_once __DIR__ . "/../Model/AnuncioDAO.php";
include_once __DIR__ . "/../Model/PessoaDAO.php";

include_once __DIR__ . "/../NucleoClass/AnimalDTO.php";
include_once __DIR__ . "/../NucleoClass/EnderecoDTO.php";
include_once __DIR__ . "/../NucleoClass/PostDTO.php";
include_once __DIR__ . "/../NucleoClass/PessoaDTO.php";
include_once __DIR__ . "/../NucleoClass/Usuario.php";
include_once __DIR__ . "/../NucleoClass/AcessoDTO.php";
include_once __DIR__ . "/../NucleoClass/AnuncioDTO.php";
include_once __DIR__ . "/../NucleoClass/Patrocinador.php";




include_once __DIR__ . "/GerarPaginaWebPost.php";

if(isset( $_REQUEST['ACAO_FORM']))  /*função fora da classe, executa sem chamar classe, código somente para esse arquivo*/  
{  /*isset: verificação se o valor, a variavel existe*/  
   $RETORNO = FormController::main($_REQUEST['ACAO_FORM']);  /*request: post e get em uma variavel, request.*/  
}

FormController::VerificarSessao();



class FormController {  /*apenas o  nome da classe*/  

    public static $CON;  /*valor conexão*/  
    /**
     * @param type $oper
     * @return type
     */
    public static function main($oper) /*principal metodo da classe: main*/  
    {
        self::$CON = new Conexao();
        
        switch($oper)  /*switch:if*/    /*$oper: operação, valor do parametro*/  
        {
            case "LOGIN":   
              
                self::FormLogin();
                
               break;   
            
            case "CADASTRO-POST":

                $IdEndereco = self::FormNovoEndereco();
                $IdAcesso   = self::FormSalvarAcesso();
                $IdTelefone = self::FormSalvarTelefone();
                $Post       = self::FormCadastroPost();
                $IdPessoa   = self::FormCadastroPessoa($IdEndereco , $IdTelefone , $IdAcesso , $Post->getId()  , NULL);
                              self::FormNovoAnimal($IdPessoa , $Post->getId() );
                              
                 SessionController::verificarLogin( 
                               self::getKey('cadastro-login')
                              ,self::getKey('cadastro-senha') 
                              ,self::$CON->getCon());  /*conexão de banco de dados*/  
                              
                $Post->CaminhoLocation();             
                
                break;
            
            case "EXCLUIR_POST":
                self::FormExcluirPost();
                break;
            
            case "EDITAR_POST":
                self::FormEditarPost();
                break;
            
            case "ALTERACAO-ADMIN";
                self::FormEditarAdmin();
                break;
            
            case "ATUALIZAR_SCRIPT":
                
                return self::FomrProcessarScript();
                
            case "CADASTRO-PATROCINADOR":
                
                $IdEndereco = self::FormNovoEndereco();
                $IdAcesso   = self::FormSalvarAcesso();
                $IdTelefone = self::FormSalvarTelefone();
                $IdAnuncio  = self::FormCadastroAnuncio($IdTelefone , $IdPessoa = null);
                
                $IdPessoa   = self::FormCadastroPessoa($IdEndereco , $IdTelefone , $IdAcesso , NULL ,$IdAnuncio , 2 );
                
                SessionController::verificarLogin( 
                               self::getKey('cadastro-login')
                              ,self::getKey('cadastro-senha') 
                              ,self::$CON->getCon());  /*conexão de banco de dados*/  
                
                break;
            case "ATUALIZAR_Anuncio":
                
                AnuncioDAO::Aprovar( self::getKey('Anuncio-Id'), self::$CON->getCon() );
                
                break;
            
            case "Excluir_Anuncio":
                
                AnuncioDAO::Excluir( self::getKey('Anuncio-Id'), self::$CON->getCon() );
                
                break;
            
            case "Excluir_Post":
             
                break;
            
            
            
            
            default:  /*valor não encontrado e aciona o controle de erro:*/  

                ErroController::erroFatal("nao foi possivel efetuar o controle de formularios para a acao: " . $oper);
                break;
        }
    }
    
    public static function VerificarSessao()
    {
        SessionController::VerificarSession();
    }
    
    
    private static function FomrProcessarScript(){
        
       return AdminDAO::ProcessarScriptSql(self::getKey('SCRIPT_TEXTO') ,self::$CON->getCon() );
        
    }
    /**
     * 
     * @param type $key
     * @return type
     */
    public static function  getKey($key = 'default')  /*busca chave, key: array*/  
    {
        if(array_key_exists($key, $_REQUEST))  /*verificando se o valor existe no request*/  
        {
            return $_REQUEST[$key];  /*se sim retorna a chave*/  
        }
        else
        {
            ErroController::erroFatal("Solicitacao de valor nao existe para o input no formulario enviado : " . $key ." :: RESQUEST : <pre>". print_r($_REQUEST)."</pre>");
            /*se não retorna o erro*/ 
        }
    }
    /**
     * Carregar arquivo
     */
    private static function FormUploadFile($nome , $caminho = "../view/Contents/img/")
    {
        if(array_key_exists($nome, $_FILES))
        {           
            $File = $_FILES[$nome];
            $ext = strtolower(substr($File['name'], -4));
            $NomeArquivo = md5(time()) . $ext;
            $Dir = $caminho . $NomeArquivo;
            
            move_uploaded_file($File["tmp_name"] ,__DIR__ ."/". $Dir);
            print_r($NomeArquivo);
            return $NomeArquivo;
            
        }
        else
        {
            ErroController::erroFatal("Nao foi possivel achar o arquivo : " . $nome);
        }
    }
    
    private static function FormLogin()
    {
     
        SessionController::verificarLogin( self::getKey('USUARIO')
                                          ,self::getKey('SENHA') 
                                          , self::$CON->getCon());  /*conexão de banco de dados*/  
    }
    /**
    * CRUD PESSOA
    */
    /**
     * 
     * @param type $IdEndereco
     * @param type $IdTelefone
     * @param type $IdAcesso
     * @param type $IdPost
     * @param type $IdAnuncio
     * @param type $tipoPEssoa
     * @return \Usuario
     */
    private static function FormCadastroPessoa($IdEndereco , $IdTelefone , $IdAcesso ,$IdPost,$IdAnuncio , $tipoPEssoa = 1)
    {
        
        $Usuario = new Usuario(
                                 null // ID
                                ,self::getKey("cadastro-nome")
                                ,self::getKey("cadastro-sobrenome")
                                ,self::getKey("cadastro-sexo")
                                ,self::getKey("cadastro-dataNescimento")
                                ,TRUE
                                ,$IdPost
                                ,$tipoPEssoa 
                                ,$IdTelefone
                                ,$IdEndereco
                                ,$IdAcesso
                                ,$IdAnuncio);
        
       // retorna o $id da pessoa no banco
       $Usuario->setId( $Usuario->CadastrarUsuario(self::$CON->getCon()) );
       
       return $Usuario;
    }

    ////////////////////////////// END acoes para PESSOA

    /**
  * CRUD Endereco
  */
    /*
     * return $id 
     */
    private static function FormNovoEndereco()
    {
       $Endereco = new EnderecoDTO(
                                Null // $ID
                               ,self::getKey("cadastro-CEP")
                               ,self::getKey("cadastro-endereco")
                               ,self::getKey("cadastro-Complemento")
                               ,self::getKey("cadastro-estado")
                              );
       
       return EnderecoDAO::SetNovoEndereco($Endereco, self::$CON->getCon());
    }
    
    
   ////////////////////////////// END acoes para ENDERECO
/**
  * CRUD ANIMAl
  */
    /* Novo Post
     * @id int , id da pessoa 
     * return Animal Objeto
     */
    private static function FormNovoAnimal($idPessoa , $idPost)
    {
       $Animal = new AnimalDTO(  null // ID 
                                ,self::getKey("POST-ANIMAL-TIPO")
                                ,self::getKey("POST-NOME-PET")
                                ,self::getKey("POST-ANIMAL-PORT")
                                ,self::getKey("POST-RACA-PET")
                                ,self::getKey("POST-COR-ANIMAL")
                                ,self::getKey("POST-SEXO-PET")
                                ,self::getKey("POST-IDADE-PET")
                                ,self::FormUploadFile("CADASTRO-FOTO-ANIMAL") // salvar foto do post no banco e no servidor
                                ,true // ativo
                                ,$idPost // Post
                                ,$idPessoa // id da pessoa
                              );
       $Animal->CadastrarPet( self::$CON->getCon() );
        return $Animal;
    }
    
    
    ////////////////////////////// END acoes para ANIMAl
/**
  * CRUD POST
  */
    /**
     * @return type id do post no banco
     */
    private static function FormCadastroPost()
    {
        $Post = new PostDTO( 
                              null // id 
                            , null // Animal
                            , self::getKey("TIPO-POST")
                            , self::getKey('POST-TITULO')
                            , NULL // data criacao
                            , NULL // hora criacao
                            , true // ATIVO
                            , NULL // Caminho
                            , NULL // Localizacao
                            , NULL // Pessoa
                            , self::getKey("POST-ANIMAL-REFERENCIA"));
        
        
        $Post->gerarNomeArquivo();
        $Post->CadastrarPost( self::$CON->getCon() );
        $Post->GerarPostArquivo();
       
        
        return $Post;
    }
    /*
     * Excluir Post
     */
    private static function FormExcluirPost()
    {
        PostDAO::inativarPost(self::getKey('excluirId') , self::$CON->getCon());
    }
    /*
     * Editar Post
     */
    private static function FormEditarPost()
    {
           $post = new PostDTO( self::getKey('ID')
                               ,NULL
                               ,self::getKey('TipoPost')
                               ,self::getKey('Titulo')
                               ,self::getKey('DtCriacao')
                               ,self::getKey('HrCriacao')
                               ,self::getKey('Ativo')
                               ,self::getKey('CaminhoPost') );
        
        PostDAO::editarPost($post ,self::$CON->getCon());
    }

    ////////////////////////////// END acoes para POST
        
/**
  * CRUD Acesso
  */
    private static function FormSalvarAcesso()
    {
        $Acesso = new AcessoDTO(  null // Id
                                , self::getKey('cadastro-login')
                                , self::getKey('cadastro-senha'));
        
        

        return AcessoDAO::SalvarNovoAcesso($Acesso, self::$CON->getCon());
    }
    ////////////////////////////// END acoes para ACESSO
    
/**
  * CRUD TELEFONE
  */
    private static function FormSalvarTelefone()
    {
        $Telefone = new TelefoneDTO(  NULL
                                    , 61 //self::getKey('')
                                    , self::getKey('cadastro-telefone'));

        return TelefoneDAO::SalvarNovoTelefone($Telefone, self::$CON->getCon() );
    }
   ////////////////////////////// END acoes para Telefone    
    /**
     * 
     */
    private static function FormCadastroAnuncio( $IdTElefone , $Patrocinador){
       // print_r($_REQUEST);
        
        $Patrocinador = new Patrocinador();
        
        $Patrocinador->setEmailEmpresa(self::getKey('Email-Empresa'));
        $Patrocinador->setIdTelefone($IdTElefone);
        $Patrocinador->setNomeEmpresa(self::getKey('Empresa-nome'));
        
        $Anuncio = new AnuncioDTO(
                        NULL // $ID
                        ,date("Y-m-d")
                        ,date("hms")
                        ,self::FormUploadFile("CADASTRO-FOTO-ANUNCIO")
                        ,TRUE
                        ,False
                );
        $Patrocinador->setAnuncio($Anuncio);
        
        return $Patrocinador->CadastrarAnuncio( self::$CON->getCon() );
        
    }
    
    
    
    
    
   /**
     * Editar via admin
     */
    private static function FormEditarAdmin()
    {
        $Oper = self::getKey('tipo');
        
        //echo $Oper;
        
        switch ($Oper)
        {
            case "Pessoa":
                $pessoa   = self::getPessoa();
                $telefone = self::getTelefone();
                $Endereco = self::getEndereco();
                
                $pessoa->EditarUsuario( self::$CON->getCon() );
                $telefone->EditarTelefone( self::$CON->getCon() );
                $Endereco->EditarEndereco( self::$CON->getCon() );
                
                break;
            
            case "Post":
                self::FormEditarPost();
                
                break;
            
            case "Animal":
                
                $Animal = self::getAnimnal();
                $Animal->EditarAnimal( self::$CON->getCon() );
                
                break;
        }
    }
    
    
    //########################################################
    
    private static function getPessoa()
    {
        $Usuario = new PessoaDTO(
                         self::getKey('ID')
                        ,self::getKey("Nome")
                        ,self::getKey("Sobrenome")
                        ,self::getKey("Sexo")
                        ,self::getKey("DtNascimento")
                        ,self::getKey("Ativo")
                        ,self::getKey("POST_ID")
                        ,self::getKey("TIPOPESSOA_ID")
                        ,self::getKey("TELEFONE_ID")
                        ,self::getKey("ENDERECO_ID")
                        ,self::getKey("ACESSO_ID")
                        ,self::getKey("ANUNCIO_ID")
                    );
        
        return $Usuario;
    }
    
    private static function getTelefone()
    {
        $telefone = new TelefoneDTO(
                         self::getKey('TELEFONE_ID')
                        ,self::getKey('Ddd')
                        ,self::getKey('Numero')
                    );
        return $telefone;
    }
    
    public static function  getEndereco()
    {
        $Endereco = new EnderecoDTO(
                         self::getKey('ENDERECO_ID')
                        ,self::getKey('CEP')
                        ,self::getKey('Endereco')
                        ,self::getKey('UF')
                        ,self::getKey('UF')
                        );
        
        return $Endereco;
    }
    /**
     * 
     */
    public static function getAnimnal()
    {
        $Animal = new AnimalDTO(
                         self::getKey('ID')
                        ,self::getKey('TipoAnimal')
                        ,self::getKey('NomePet')
                        ,self::getKey('PortePet')
                        ,self::getKey('RacaPet')
                        ,self::getKey('CorPet')
                        ,self::getKey('SexoPet')
                        ,self::getKey('IdadePet')
                        ,self::getKey('FotoPet')
                        ,self::getKey('Ativo')
                        ,self::getKey('POST_ID')
                        ,self::getKey('PESSOA_ID')
                );
        
        return $Animal;
    }
}
