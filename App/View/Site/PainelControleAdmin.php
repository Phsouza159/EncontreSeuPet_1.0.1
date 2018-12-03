<!DOCTYPE html>
<?php
include_once '../Site/Layout/MenuNav.php';

include_once '../../Controller/ErroController.php';
include_once '../../Controller/GetConfigApp.php';
include_once '../../Model/Conexao.php';
include_once '../../Model/AnimalDAO.php';
include_once '../../Model/PostDAO.php';
include_once '../../Model/PessoaDAO.php';
include_once '../../NucleoClass/PostDTO.php';
include_once '../../Model/AnuncioDAO.php';

$con = new Conexao(); //conexão bando de dados

$qntPost = PostDAO::quantidadePost($con->getCon());
$qntAnimal = AnimalDAO::quantidadeAnimal($con->getCon());
$qntPessoa = PessoaDAO::quantidadePessoa($con->getCon());
$qntAnuncioAprovado = AnuncioDAO::quantidadeAprovado($con->getCon());
$qntAnunciosParaAprovacao = AnuncioDAO::quantidadeParaAprovacao($con->getCon());
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Dashbord</title>
        <!--Chamar folha css (LESS) -->
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/PainelAdministrador.less" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Buttoes.less" />
        <!--  Chamar biblioteca (LESS)-->
        <script src="../Contents/plugins/less/dist/less.js" ></script>
        <!-- include bootstrap --> 

        <link rel="stylesheet" type="text/css" href="../Contents/plugins/bootstrap/css/bootstrap.css">

        <script src="../Contents/js/jquery3.3.1.js" ></script>

        <script>
        </script>
    </head>
    <body class="p-5">
        <div class="justify-content-center">
            <p class="h3"> Painel Administrador</p>

            <button class="d2" onclick="window.location.href = 'home.php'">
                <span>home</span>
            </button>

            <button type="button" class="d2" data-toggle="modal" data-target="#modalExemplo">
                <span>Cadastro Administrador</span>
            </button>


            <!-- Modal -->
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="width: 750px; margin-left: -100px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Administrador</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">

                            <p class='h1'></p>
                            <div class="row m-2">
                                <section class="col" >  

                                    <input id="formCadastroNome"
                                           name='cadastro-nome' 
                                           type='text' 
                                           class='input-principal-cadastro' 
                                           placeholder='Nome...'> 

                                    <a class="input-name"></a> 
                                </section>
                                <section class="col">  

                                    <input id="formCadastroSobrenome" 
                                           name='cadastro-sobrenome' 
                                           type='text' 
                                           class='input-principal-cadastro' 
                                           placeholder='Sobrenome...'> 

                                    <a class="input-sobrenome"></a> 
                                </section>
                                <section class="col">  
                                    <input name='cadastro-estado' 
                                           type='text' 
                                           class='input-principal-cadastro' 
                                           value='DF' 
                                           readonly='true'>

                                    <a class="input-cadastro"></a> 
                                </section>
                            </div>

                            <div class="row m-2">

                                <section class="col"> 

                                    <select id="formCadastroCidade" class='section-cidade-group-principal-cadastro' name='cadastro-cidade'>
                                        <option class='section-cidade-group-principal-cadastro' value=''>Cidade...</option>
                                        <option class='section-cidade-group-principal-cadastro' value='Ceilândia'>Ceilândia</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Samambaia</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Taguatinga</option>   
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Plano Piloto</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Planaltina</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Águas Claras</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Recanto das Emas</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Gama</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Guará</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Santa Maria</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Sobradinho II</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>São Sebastião</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Vicente Pires</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Itapoã</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Sobradinho</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Sudoeste/Octogonal</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Brazlândia</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Riacho Fundo II</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Paranoá</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Riacho Fundo</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Estrutural</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Lago Norte</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Cruzeiro</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Lago Sul</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Jardim Botânico</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Núcleo Bandeirante</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Park Way</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Candangolândia</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Varjão</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>Fercal</option>
                                        <option class='section-cidade-group-principal-cadastro' value='cadastro-cidade'>SIA</option>

                                    </select>
                                    <a class="input-cidade"></a> 

                                </section>

                                <section class="col" > 

                                    <input id="formCadastroTelefone"
                                           name='cadastro-telefone' 
                                           type='text' 
                                           class='input-principal-cadastro' 
                                           placeholder='Telefone...'>

                                    <a class="input-telefone"></a> 
                                </section>

                                <section class="col"> 
                                    <input id="formCadastroEndereco" 
                                           name='cadastro-endereco' 
                                           type='text' 
                                           class='input-principal-cadastro' 
                                           placeholder='Endereço...'>

                                    <a class="input-endereco"></a> 
                                </section> 
                            </div>

                            <div class="row m-4">
                                <section class="col">
                                    <input id=""
                                           name='cadastro-CEP' 
                                           type='text' 
                                           class='dtNasc-calendario-group-principal-cadastro'
                                           placeholder='CEP...'/>

                                </section> 


                                <section class="col">
                                    <input id=""
                                           name='cadastro-Complemento' 
                                           type='text' 
                                           class='dtNasc-calendario-group-principal-cadastro'
                                           placeholder='Complemento...'/>

                                </section> 

                                <section class="col"> 

                                    <label>Data de Nacimento:</label>
                                    <br />
                                    <input id="formCadastroDtNascimento"
                                           name='cadastro-dataNescimento' 
                                           type='date' 
                                           class='dtNasc-calendario-group-principal-cadastro'
                                           min='1900-01-01' max='<?php echo (date("Y") - 12) . '-' . date("m-d") ?>' />

                                    <a class="input-dtNascimento"></a> 
                                </section>

                                <section class="col"> 

                                    <label>Sexo:</label>
                                    <br />
                                    <input type='radio' 
                                           name='cadastro-sexo' 
                                           value='m' 
                                           checked="checked">
                                    <span class='text-descricao-group-principal-cadastro' >Masculino</span> 

                                    <input type='radio' 
                                           name='cadastro-sexo' 
                                           value='f'>
                                    <span class='text-descricao-group-principal-cadastro'>Feminino</span> 

                                    <input type='radio' 
                                           name='cadastro-sexo'
                                           value='o'>
                                    <span class='text-descricao-group-principal-cadastro'>outro</span> 

                                </section>

                            </div>
                        </div>

                        <div class="">
                            <p class='h1'></p>

                            <br>

                            <label></label>
                            <input name='cadastro-login' 
                                   type='text' class='input-principal-cadastro' 
                                   placeholder='Login'> 
                            <br>
                            <label></label>
                            <input name='cadastro-senha' 
                                   type='password' 
                                   class='input-principal-cadastro' 
                                   placeholder='Senha'> 

                            <br>

                            <label></label>
                            <input name='cadastro-senha-confirmação' 
                                   type='password' 
                                   class='input-principal-cadastro' 
                                   placeholder='Confirmar Senha'> 

                            <br>

                        </div>

                        <div class="modal-body">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        </hr>
        <div class="body-elementos-painel">
            <p class="h1" style="">Elementos Diponiveis</p>
            <div class="body-elementos-painel-overflow">

                <table>
                    <tr>
                        <td>
                            <!--
                            
                            -->
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card p-2" style="background-color: #d58512; color: black"> 
                                    <p class="h6">Anúncios</p>
                                    <p class="h1"> <?php echo $qntAnuncioAprovado ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Anúncios</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="BT-VISULIZAR-ANUNCIOS-APROVADOS">
                                            <span>visualizar Pots</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td>
                            <!--
                            
                            -->
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card p-2" style="background-color: #f30909; color: black"> 
                                    <p class="h6">Anúncios para aprovação</p>
                                    <p class="h1"> <?php echo $qntAnunciosParaAprovacao ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Anúncios</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="BT-VISULIZAR-ANUNCIOS">
                                            <span>visualizar Pots</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td>
                            <!--
                            
                            -->
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card p-2" style="background-color: darkcyan; color: black"> 
                                    <p class="h6">Quantidade de Pessoas registradas</p>
                                    <p class="h1"> <?php echo $qntPessoa ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Pessoas</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="BT-VISULIZAR-PESSOA">
                                            <span>visualizar Pots</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td>
                            <!--
                            
                            -->
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card p-2">
                                    <p class="h6">Quantidade de pots registrados</p>
                                    <p class="h1"> <?php echo $qntPost ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Pots</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="BT-VISULIZAR-POTS">
                                            <span>visualizar Pots</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </td>

                        <td>
                            <!--
                            
                            -->
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card p-2" style="background-color: greenyellow; color: black">
                                    <p class="h6">Quantidade de Animais registrados</p>
                                    <p class="h1"> <?php echo $qntAnimal ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Animal</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="BT-VISULIZAR-ANIMAIS">
                                            <span>visualizar Animais</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td><td>
                            <!--
                           
                            -->
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card p-2" style="background-color: buttonface; color: black">
                                    <p class="h6">Controle Banco de Dados</p>
                                    <p class="h1">@</p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">atualizacao de scripts</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="BT-VISULIZAR-BANCODADOSATUALIZAR">
                                            <span>Visulizar Banco de Dados</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td><td>               
                            <!--
                           
                            -->
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card p-2" style="background-color: #117a8b; color: #fff">
                                    <p class="h6">Gerênciador de banco de Dados</p>
                                    <p class="h1">@</p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">ControleAvançado Banco de Dados</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="BT-VISULIZAR-PHPMYADMIN">
                                            <span>PhpMyAdmin</span>
                                        </button>
                                    </div>
                                </div>
                            </div>              
                            <!--
                           
                            -->
                        </td><td>
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card" style="background-color: gray; color: black">
                                    <p class="h6">...</p>
                                    <p class="h1">...</p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">...</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="" >
                                            <span>...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--
            
                            -->
                        </td><td>
                            <div class="float-card card card-sombra m-4" style="width: 18rem;">
                                <div class="exibicao-numero-card" style="background-color: gray; color: black">
                                    <p class="h6">...</p>
                                    <p class="h1">...</p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">...</h5>
                                    <p class="card-text">...</p>
                                    <div>
                                        <button class="d2" id="">
                                            <span>...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <!--
        
                        -->
                    </tr>
                </table>
            </div>
        </div>
        <?php
        // put your code here
        ?> 

        <div class="body-acaoes">

            <div class="collapse" id="collapseExample">
                <div class="card card-body iframe-controle">
                    <span id="POST-TABELA">

                        <h1>Selecione Um elemento :)</h1>
                    </span>
                </div>
            </div>


        </div>
        <script src="../Contents/plugins/bootstrap/js/bootstrap.js"></script>
        <script>

                $(function () {

                    $("#BT-VISULIZAR-PESSOA").click(function () {
                        Controle_collapse();
                        InserirIframe("Pessoa");
                    });

                    $("#BT-VISULIZAR-POTS").click(function () {
                        Controle_collapse();
                        InserirIframe("Post");
                    });

                    $("#BT-VISULIZAR-ANIMAIS").click(function () {
                        Controle_collapse();
                        InserirIframe("Animal");
                    });

                    $("#BT-VISULIZAR-BANCODADOSATUALIZAR").click(function () {
                        Controle_collapse();
                        InserirIframe("CONTROLE_SCRIPTS");
                    });

                    $("#BT-VISULIZAR-ANUNCIOS").click(function () {
                        Controle_collapse();
                        InserirIframe("CONTROLE_ANUNCIOS");
                    });

                    $("#BT-VISULIZAR-ANUNCIOS-APROVADOS").click(function () {
                        Controle_collapse();
                        InserirIframe("ANUNCIOS");
                    });


                    $("#BT-VISULIZAR-PHPMYADMIN").click(function () {
                        Controle_collapse();
                        InserirIframe("http://127.0.0.1:8080/eds-modules/phpmyadmin470x180902201004/index.php", true);
                    });


                    function InserirIframe(FrameIclude, custom = false)
                    {

                        if (!custom)
                        {
                            document.getElementById("POST-TABELA").innerHTML = "<iframe class='iframe-style' src='./Layout/ModeIframeAdmin.php?tipo=" + FrameIclude + "' frameborder='0' allowfullscreen></iframe>";
                            // controle_iframe = true;
                        } else if (custom)
                        {
                            document.getElementById("POST-TABELA").innerHTML = "<iframe class='iframe-style' src='" + custom + "' frameborder='0' allowfullscreen></iframe>";
                            //   controle_iframe = true;
                    }

                    }

                    function Controle_collapse(invisivel = false)
                    {
                        if (!invisivel)
                        {
                            $('#collapseExample').show();
                            $('#POST-TABELA').show();
                        } else
                        {
                            $('#collapseExample').hide();

                    }
                    }

                });
        </script>
    </body>
</html>
