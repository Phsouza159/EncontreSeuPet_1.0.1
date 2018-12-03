<?php

include_once __DIR__ . "../../Model/Conexao.php";
include_once __DIR__ . "../../Model/PostDAO.php";
include_once __DIR__ . "../../Model/AnimalDAO.php";
include_once __DIR__ . "../../Controller/ErroController.php";


 class GerarPaginaWebPost 
 {
     private static $Con;
     private static $Post;
     private static $paginaWeb;     // pagina a ser criada 
     private static $caminhoSalvar  = "../Posts/"; // caminho a onde vai ser salvo o arquivo fisico

     
     public static function main(PostDTO $Pots = null)
     {
         if(is_null($Pots))
         {
             ErroController::erroFatal("Erro na passagem de parametros na classe Gerar Pots! Falto o Post");
         }
         
        
         self::$Con = new Conexao(); 

         self::$Post = $Pots;
         self::GerarPagina();      
     }   

     private static function GerarPagina( )
     {
         try {
                date_default_timezone_set('America/Sao_Paulo'); // configurar hora

                $Titulo = ucwords(self::$Post->getTitulo()); // pegar o titulo do post e colocar tudo em minusculo

                $nomeArquivi = $Titulo . date("ymd"); // titulo + gerar data

                $nomeArquivi = str_replace(" ", "", $nomeArquivi) . rand(0, 100) . ".php"; // remover espacos 

                self::$Post->setId(PostDAO::Get_NEXT_ID_AUTO_INCREMENT_TABLE('post', self::$Con->getCon() ));
                self::$Post->setCaminhoPost($nomeArquivi);
            
        } catch (Exception $ex) {
            ErroController::erroFatal("Erro ao configura pagina fisica do post :: " . $ex->getMessage() . " ; na linha " . $ex->getLine());
        }


        $POST_PREPARA = "<?php
   \$id_POST = '".self::$Post->getId()."'; 
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
        
        self::$Post->GetAnimal()->setPOST( self::$Post->getId() ); // passar o id do post para o animal
        
        //echo "<pre>";
        //    print_r(self::$Post);
        //echo "</pre>";
        //exit;
        PostDAO::SalvePost(self::$Post , self::$Con->getCon());
        AnimalDAO::SetNovoAnimal(self::$Post->getAnimal(), self::$Con->getCon());
                
         
         if(file_put_contents(self::$caminhoSalvar.$nomeArquivi , $POST_PREPARA ))
         {
             header("location: ".self::$caminhoSalvar.$nomeArquivi);
         }
         else
         {
             ErroController::erroFatal("Erro ao tentar criar Post");
             exit;
         } 
     }
 }