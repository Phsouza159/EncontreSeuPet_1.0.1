<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../../Controller/FormController.php';
include_once '../../NucleoClass/AnuncioDTO.php';
include_once './Layout/MenuNav.php';

    if(isset($_GET['acao'])) 
    {
        unset($_SESSION['SESSION_USER_LOG']);
        header("Location: ./home.php");
    }
?>
<html>
    <head>
        <title>Home</title>
        <meta name="viewport" content="width=device-width">
        <!--Chamar folha css (LESS) -->
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Home.less?v=1" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/footer.less?v=1" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Anuncios.less?v=2" />
        <!-- Chamar biblioteca (LESS)-->
        <script type="text/javascript" src="../Contents/plugins/less/dist/less.min.js"></script> 
        
        <link rel="stylesheet" href="../Contents/Css/font-awesome.css" type="text/css" />
        <!-- include bootstrap --> 
         <link rel="stylesheet" type="text/css" href="../Contents/plugins/bootstrap/css/bootstrap.css">
    </head>
    <body>

        <?php
          MenuNav::menu();
        ?>

        <div id="carouselExampleFade" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>  
                <li data-target="#carouselExampleFade" data-slide-to="1"></li>
                <li data-target="#carouselExampleFade" data-slide-to="2"></li>
                <li data-target="#carouselExampleFade" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">


                <div class="carousel-item active">
                    <div class='div-01'>   
                        <div class='conteiner-corpo'>
                            <center> 
                                <h1></h1>
                                <h3> 
                                    
                                    <span>
                                        Cadastre-se aqui e crie um post
                                        <br>
                                        para seu animal desaparecido ou para doação.
                                        <br>
                                    </span>
                                </h3>
                                 <br>
                                  <br>
                                  <button tupe='button' class="btn-acao-links" onclick="window.location.href = './Cadastro.php'">Cadastrar</button> 
                            <!-- -->    <!--   <button tupe='button' class="btn-acao-links" onclick="window.location.href = './Visitante.php'">Visitantes</button> --> 
                            </center>
                        </div>
                    </div>
                </div>

                <div class="carousel-item div-02">
                    <div class=''>
                        <div class='conteiner-corpo'>
                            <center> 
                                <h1></h1>
                                <h3> 
                                    <span>
                                        Posts de animais desaparecidos.<br>
                                        Ajude a encontra-los!
                                       
                                        
                                    </span>
                                </h3>

                       <button tupe='button' class="btn-acao-links" onclick="window.location.href = './Posts.php?tipo=2'">Visualizar</button>  
                            </center>             
                        </div>

                    </div>
                </div>
                <div class="carousel-item div-03">
                    <div class=''>
                        <div class='conteiner-corpo'>
                            <center> 
                                <h1></h1>
                                <h3> 
                                     <span>
                                        Posts de animais para adoção.<br>
                                        Adote, porque o amor não tem preço nem raça.
                                        
                                        
                                    </span>
                                </h3>
                                <button tupe='button' class="btn-acao-links" onclick="window.location.href = 'sim, e n./Posts.php?tipo=1'">Visualizar</button>
                            </center>
                        </div> 
                    </div>
                </div>

                <div class="carousel-item div-04">
                    <div class=''>
                        <div class='conteiner-corpo'>
                            <center> 
                                <h1></h1>
                                <h3> 
                                    <span>
                                         
                                        Torne-se patrocinador, <br>
                                        E venha fazer parte da nossa equipe!                                              
                                    </span>
                                </h3> 
                                <button class="btn-acao-links" onclick="window.location.href = './CadastroPatrocinador.php'">Cadastrar</button>
                            </center>
                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div>
       <?php

        AnuncioDTO::GerarAnuncio();

       ?> 
       
        
        <footer class="footer-body">
           <?php
              MenuNav::footer();
           ?>

        </footer>

        <!-- Chamar dependencias javascript -->
        <script src="../Contents/js/jquery3.3.1.js"></script>
        <script src="../Contents/plugins/bootstrap/js/bootstrap.js"></script>

    </body>
</html>


