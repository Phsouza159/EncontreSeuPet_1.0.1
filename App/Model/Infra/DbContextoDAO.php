<?php

/**
 * Description of DbContexto
 *
 * @author paulo-pc
 */

//echo __DIR__;

class DbContextoDAO {

    private static $DataConfig; //config de acesso ao banco static 
    /*
     * Carregar conexao
     */
    public static function ConexaoMysql() { 
       try {
            self::GetConfiguracaoServer(); 
            
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    );

            $con = new PDO(
                    "mysql:host=" . self::$DataConfig['host'] 
                    . ";dbname=" . self::$DataConfig['datasource']
                    , self::$DataConfig['user']
                    , self::$DataConfig['password']
                    , $options
                    );

            if (!$con) {
                ErroController::erroFatal("Nao foi possivel estabelecer conexao com host ".self::$DataConfig['host'] .": " . $con->getMessage());
                exit;
            }
            return $con;
       } catch (Exception $con) {
           ErroController::erroFatal("Erro ao conectar ao banco: " . $con->getMessage());
          exit;
       }
    }

    public static function ConexaoMysql_Close($con) {
        if ($con) {
           $con = null;

        } else
        {
        }
    }

    /**
     * Carregar configuracao do app config;
     */
    private static function GetConfiguracaoServer() {
        
        $tipoConexao = GetConfigApp::Get("tipo_conexao");
            // ErroController::erroFatal("Nao foi possivel verificar o tipo de conexao a ser feita pela aplicacao: DbContextoDAO");
     
        if($tipoConexao['localhost'] == true)
        {    
          self::setDataConfig(GetConfigApp::Get("conexao_mysql_localhost"));
        }
        elseif($tipoConexao['webhost'] == true)
        {
          self::setDataConfig(GetConfigApp::Get("conexao_mysql_webhost"));
        }
        elseif(GetConfigApp::Get("webhost") == false && GetConfigApp::Get("localhost") == false)
        {
            ErroController::erroFatal("Nem uma tipo de conexao definida para a base de dados");
        }
    }
    
    private static function getDataConfig() {
        return self::$DataConfig;
    }

    private static function setDataConfig($DataConfig) {
        self::$DataConfig = $DataConfig;
    }

}
