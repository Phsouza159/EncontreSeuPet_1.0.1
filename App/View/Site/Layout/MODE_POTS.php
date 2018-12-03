<?php
include_once '../Site/Layout/MenuNav.php';

include_once '../../Controller/ErroController.php';
include_once '../../Controller/GetConfigApp.php';
include_once '../../Model/Infra/CollectionsQuerys.php';
include_once '../../Model/Infra/DbContextoDAO.php';
include_once '../../Model/Conexao.php';
include_once '../../Model/AnimalDAO.php';
include_once '../../Model/PostDAO.php';
include_once '../../NucleoClass/AnimalDTO.php';
include_once '../../NucleoClass/AnuncioDTO.php';
include_once '../../NucleoClass/PostDTO.php';



$con = new Conexao();
//AnimalDAO::GetAnimal(1 , $con->getCon());
$post = PostDAO::getPost($id_POST, $con->getCon());

//echo "<pre>";
//   print_r($post);
//echo "</pre>";

if (is_null($post)) {
    ErroController::erroFatal("Erro ao carregar Post -- Post vazio :(");
}
if(is_null($post->getAnimal()))
{
    ErroController::erroFatal("Post sem Animal vinculado");
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Encontre seu Pet</title>

        <meta name="viewport" content="width=device-width">
        <!--Chamar folha css (LESS) -->
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Post.less?v=1.0.1" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/buttoes.less?v=1.0.1" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/footer.less?v=1.0.1" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Anuncios.less?v=1" />
        <!-- Chamar biblioteca (LESS)-->
        <script src="../Contents/plugins/less/dist/less.js" ></script>
        <!-- include bootstrap --> 
        <!-- <link rel="stylesheet" type="text/css" href="../Contents/css/bootstrap.css"> -->
        <link rel="stylesheet" href="../Contents/plugins/bootstrap/css/bootstrap.css">
    </head>
    <body>
<?php
MenuNav::menu('../Site/');

?>
        <div class="container">

            <div class="row m-5">

                <section class="col-sm">
<?php echo "<section class='img-pet-pot' style=\"background-image: url('../Contents/img/".$post->getAnimal()->getFotoPet()."')\"></section>"?>
                </section>

                <section class="col-sm justify-content-center">
                    <p class="h1 post-titulo text-info"><?php echo $post->getTitulo() ?></p>
                    
                    <p class="post-publicacao-text"><?php echo "Data de publicação: " . $post->getDtCriacao()?>
                                as: <?php echo $post->getHrCriacao()?></p>
                    <hr />
                    <ul class="descricao-pet">
                        <li>Nome do Pet: <?php echo $post->getAnimal()->getNomePet(); ?></li>
                        <li>Porte do Pet: <?php
                                                $Porte = $post->getAnimal()->getPortePet();
                                                echo ($Porte == 2) ? "Pequeno" :  $Porte  == 1 ? "Médio" : "Grande"; 
                                            ?></li>
                        <li>Raça do Pet: <?php echo $post->getAnimal()->getRacaPet(); ?></li>
                        <li>Cor do Pet: <?php echo $post->getAnimal()->getCorPet(); ?></li>
                        <li>Sexo Pet: <?php
                                                 $Sexo = $post->getAnimal()->getSexo(); 
                                                 echo $Sexo == 0 ? "Macho" : "Fêmea";
                                        ?></li>

                        <li>idade Pet: <?php echo $post->getAnimal()->getIdadepet(); ?> anos</li>
                        <li>Localização: <?php echo $post->getReferencia(); ?></li>
                        
                    </ul>
                    <section class="col m-2">
                    </section>
                </section>

            </div>
            <p class="h3 col">Descrição Dono:</p>
            <hr />
            <div class="row">
               
                    <ul class="descricao-pet">
                        <li>Nome: <?php echo $post->getPessoa()->getNome(); ?></li>
                        <li>Sobrenome: <?php echo $post->getPessoa()->getSobrenome(); ?></li>
                        <li>Sexo: <?php
                                     $Sexo = $post->getPessoa()->getSexo();
                                     echo $Sexo == 'f' ? "Feminino" : "Masculino";
                                     
                                     
                                  ?></li>
                        <li>Data de nascimento: <?php echo $post->getPessoa()->getDtNascimento(); ?></li>
                        <li>Endereco: <?php echo 
                                              $post->getPessoa()->getEndereco()->getEndereco() . " " 
                                            . $post->getPessoa()->getNome() . " " 
                                            . $post->getPessoa()->getEndereco()->getComplemento() ; ?></li>
                        <li>Telefone: <?php echo "(" . $post->getPessoa()->getTelefone()->getDdd() . ") " . $post->getPessoa()->getTelefone()->getNumero()  ?></li>
                    </ul>
    
            </div>
        
                <div>
                    <button class='btn btn-primary' onclick="window.location.href = '../Site/Cadastro.php'" >Criar novo Posts</button>
                    <button class='btn btn-primary' onclick="window.location.href = '../Site/Posts.php'" >Voltar Galeria</button>
                </div>
<?php AnuncioDTO::GerarAnuncio(); ?>
            
        </div>
                <?php
                MenuNav::footer();
                ?>
    </body>
</html>
