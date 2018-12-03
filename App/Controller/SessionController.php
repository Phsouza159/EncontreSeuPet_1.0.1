 <?php


include_once __DIR__ . "/ErroController.php"; /*DIR: endereço de onde esta a classe, endereço fisico e inclui direto*/
include_once __DIR__ . "/GetConfigApp.php";

Class SessionController
{
    private static $config; /*static = não há necessidade de estanciar, ou seja, não precisa criar um objeto*/
    private static $reload; /* pega ultima url*/
    
    public static function validarAcesso() /*valida o acesso*/
    {
        self::$config = GetConfigApp::Get("Server_hospedagem"); /*self: apelido da classe. Self só é valido para o static, o self apelida*/
        
        self::sessionStatus(); /**/
        self::VerificarLogin();
        
    }
    /**
     * 
     * @param type $user
     */
    private static function setSessionUser(  $user = null ) 
    {
        date_default_timezone_set('America/Sao_Paulo');
        self::sessionStatus();
        
        $user = array(
                 'USER_ATIVO'     => 'Ativo'
                ,'INICIO_SESSAO' => date("h:m:s")
                ,'USER_DADOS'    => $user
        );
        
        $_SESSION['SESSION_USER_LOG'] = $user; /* criando uma sessão com o indice */ 
        //echo "<pre>";
        //    print_r($_SESSION['SESSION_USER_LOG']);
        //echo "</pre>";
    }
    
    private static function sessionStatus() /* verificar se a sessão esta ligada ou desligada */ 
    {
        if(session_status() !== PHP_SESSION_ACTIVE)/* variavel global:session_status= se está ligada a sessão */ 
        {
            session_start(); /* inicando sessão*/ 
            return true; /*retorno como verdadeiro*/ 
        }
    }
    
    public static function VerificarSession()
    {
        self::sessionStatus();
        
        $session = isset( $_SESSION['SESSION_USER_LOG']) ? 
                           $_SESSION['SESSION_USER_LOG']
                             : null;
        if(is_null($session))
        {
            
        }
        
        if($session['USER_ATIVO'] == 'Ativo')
        {
            return  $session;
        }
        
        return false;
    }
    /**
     * 
     * @param type $login
     * @param type $senha
     * @param type $conexao
     */
    public static function verificarLogin($login = null , $senha = null , $conexao = null) /*três parametros */ 
    { 
        $user = PessoaDAO::getLogin($login ,$senha , $conexao);
        
        if(is_object($user))
        {
           self::setSessionUser($user);
        }
        else{
            echo "<script>alert('Usuario ou senhas incoretas')</script>";
        }
    }
}
