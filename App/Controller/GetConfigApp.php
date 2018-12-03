 <?php
/**
 * Description of ConfigApp
 *
 * @author paulo
 */
class GetConfigApp {  /*localiza o arquivo e depois se encontra-lo vai ler o arquivo, essa é a função dessa classe*/  

    private static $configuracao ; /*recebe toda a informação em forma de array de AppConfig.ini*/
    private static $nomeArquivoConfiguracao    = "AppConfig.ini";
    
  /**/  
    public static function Get($args = null)  /*puxar, ou buscar.*/  
    {
        self::LocalizacaoArquivo();  /*encontra o arquivo*/  
        self::LerArquivoConfiguracao(); /**/  
        
       if(is_null($args))
       {
            ErroController::erroFatal("Argumento nulo na chamada de configuracao: ConfigApp");
       }
       if(array_key_exists($args, self::$configuracao))  /*verificando se o indice existe*/  
       {
           return self::$configuracao[$args];
       }
       else
       {
           ErroController::erroFatal("Nao existe valor no arqumento de configuracao: ConfigApp");
       }
    }
    
    private static function LerArquivoConfiguracao()
    {
       self::$configuracao = parse_ini_file(self::LocalizacaoArquivo() , true);  /*função que ler arquivo parse_ini..*/  
        /*echo "<pre>";
       print_r(self::$configuracao);
       echo "</pre>";*/
    }
    
    
    private static function LocalizacaoArquivo()
    {
        $cam = self::$nomeArquivoConfiguracao; /*recebe o nome do arquivo*/  
          
        if(file_exists("./App/".$cam))  /*esse arquivo exiti nesse caminho,  e for vdd*/  
        {
            return "./App/".$cam;  /*retorna o caminho do arquivo */  
        }
        for($int = 10 ; $int > 0 ; $int--)  /* se não existir, entra no laço for*/  
        {
            
            if(file_exists($cam))  /* pergunta se o arquivo existe*/  
            {
                return $cam;
            }
            $cam = "../" . $cam;  /* ".." : volta uma pasta*/  
        }
             
        
       ErroController::erroFatal("Erro fatal, nao foi possivel localizar o arquivo de configuracao: ConfigApp");
    }  /*erro de controle. erro fatal: trava o sistema*/  
}
