<?php
 include_once '../Site/Layout/MenuNav.php';
 include_once '../../Controller/FormController.php';   
 include_once '../../Controller/PaginacaoPots.php';
  
  
  $i = isset($_GET['tipo']) ? $_GET['tipo'] : 1;
  
  if($i < 0 || $i > 2)
       $i = 1;
  
   $con = new Conexao(); //conexão bando de dados
   
   $qntPost = PostDAO::quantidadePost( $con->getCon() );  
   
   $GaleriaPosts = new PaginacaoPots( $qntPost 
                                      , PostDAO::getPostALL( $con->getCon() , false , $i)
                                      , 4);

 ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Cadastro</title>
                <!--Chamar folha css (LESS) -->
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Post.less?v=1.0.8" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/footer.less?v=1.0.8" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Anuncios.less?v=1" />
        <!-- Chamar biblioteca (LESS)-->
        <script src="../Contents/plugins/less/dist/less.js" ></script>
        <!-- include bootstrap --> 
        <link rel="stylesheet" type="text/css" href="../Contents/plugins/bootstrap/css/bootstrap.css">
        
    </head>
    <body>
        <?php
         MenuNav::menu();
         ?>
        
        <div class="container">
           <?php
            $GaleriaPosts->ViewMiniPost($i);
          ?>
        </div>
        
         <?php
           MenuNav::footer();
         ?>
           
        <!-- Chamar dependencias javascript -->
        <script src="../Contents/js/jquery3.3.1.js"></script>
        <script src="../Contents/plugins/bootstrap/js/bootstrap.js"></script>
    </body>
    
</html>
