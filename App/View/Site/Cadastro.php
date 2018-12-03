<?php
include_once './Layout/MenuNav.php';

include_once '../../Controller/FormController.php';


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro</title>
        <meta name="viewport" content="width=device-width">
        <!--Chamar folha css (LESS) -->
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/Cadastro.less?v=1.0.8" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/footer.less?v=1.0.8" />
        <link rel="stylesheet/less" type="text/css" href="../Contents/css/CriarPots.less?v=1.22" />

        <!-- Chamar biblioteca (LESS)-->
        <script src="../Contents/plugins/less/dist/less.js" ></script>
        <script src="../Contents/js/jquery3.3.1.js" ></script>
        <!-- include bootstrap --> 
        <link rel="stylesheet" type="text/css" href="../Contents/plugins/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="./Layout/post/dist/summernote-lite.css">
        <!-- Icones  -->
        <link rel="stylesheet" href="../Contents/Css/font-awesome.css" type="text/css" />

        <style>
            input[type=text], select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            
           input[type=password], select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type=submit] {
                width: 100%;
                background-color: #4CAF50;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }

            .div-cadastro {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }

            .passo2, .passo3{
                display:none;
            }


        </style>
        <script type="text/javascript">
            //$('#summernote').summernote();
            $(document).ready(function () {
                $('#summernote').summernote({
                    widht: 400,
                    height: 400,
                    tabsize: 2
                });
            });

            function esconderFormularioPrincipal(oper = 0)
            {
                var formulario = document.getElementById('formularioPrincipal');
                var texto = document.getElementById('texto');
                var opcaoPet = document.getElementById('opcaoPet');
                var tipoPostValor = document.getElementById('tipoPostValor');


                switch (oper)
                {
                    case 0:
                        formulario.hidden = !formulario.hidden;
                        break;

                    case 1:
                        formulario.hidden = !formulario.hidden;
                        opcaoPet.hidden = !opcaoPet.hidden;
                        texto.innerHTML = "Perdido ";
                        tipoPostValor.value = 1;
                        break;

                    case 2:
                        formulario.hidden = !formulario.hidden;
                        opcaoPet.hidden = !opcaoPet.hidden;
                        texto.innerHTML = "Doação";
                        tipoPostValor.value = 2;
                        break;

                    case 3:
                        formulario.hidden = !formulario.hidden;
                        opcaoPet.hidden = !opcaoPet.hidden;
                        texto.innerHTML = "";


                        break;
            }
            }
        </script>

    </head>
    <body onload="esconderFormularioPrincipal(0)">
        <?php
        MenuNav::menu();
        ?>

        <div <!--class="conteiner-center"-->

            <div class='container'>

                <div class="row m-5 controle-etapas justify-content-center">

                    <section class="etapas1 etapas-cards etapas-cards-active">
                        <label class="etapas-icon"><i class="fa fa-user"></i></label>
                        <label class="etapas-descricao text-center">Pessoa</label>
                    </section>

                    <section class="etapas-linha"></section>

                    <section class="etapas2 etapas-cards">
                        <label class="etapas-icon"><i class="fa fa-key"></i></label>
                        <label class="etapas-descricao text-center">Login</label>
                    </section>

                    <section class="etapas-linha"></section>

                    <section class="etapas3 etapas-cards">
                        <label class="etapas-icon"><i class="fa fa-paw"></i></label>
                        <label class="etapas-descricao text-center">Post</label>
                    </section>

                </div>

                <form action="Cadastro.php" method="POST" enctype="multipart/form-data">

                    <input type='hidden' value='CADASTRO-POST' name='ACAO_FORM' />

                    <div class="passo1">

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
                        <input type="button"  class="button_passo2" value="seguinte" />
                    </div>

                    <div class="passo2">
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

                        <input type="button" class="button_passo1" value="voltar" />
                        <input type="button" class="button_passo3" value="seguinte" />
                    </div>

                    <div class="passo3">

                        <div id="opcaoPet" class="opcaoes-pet row">

                            <a onclick='esconderFormularioPrincipal(1)' class='card opcao-perdido col p-5'>
                                <section>
                                    Perdido
                                </section>
                            </a>
                            <center>
                                <div style='padding-top: 150px'>Qual Post de sua preferência?<br/> Escolha uma opcão, clique em um dos cards.</div>
                                <hr  />
                            </center>
                            <a onclick='esconderFormularioPrincipal(2)' class='card col opcao-doacao p-5'>
                                <section>
                                    Doação 
                                </section>
                            </a>
                        </div>


                        <div id="formularioPrincipal">

                            <section claas='row'>
                                <h1>  
                                    <label id='texto'></label>
                                </h1>
                                <a  class='btn btn-info' onclick="esconderFormularioPrincipal(3)">Escolher outra opcão</a>
                            </section>

                            <label class="col-sm-2 col-form-label">Tipo Pet:</label>

                            <section class="col m-2"> 

                                <select class="form-control m-2" style="width: 200px"
                                        name="POST-ANIMAL-TIPO">
                                    <option value="0" checked>Gato</option>>
                                    <option value="1">Cachorro</option>
                                </select>
                            </section>

                            <section class="row"> 

                                <input id='tipoPostValor' type='hidden' value='1' name='TIPO-POST'>

                                <label class="col-sm-2 col-form-label">Insira o Titulo:</label>

                                <section class="form-group col m-2">     
                                    <input type="text"
                                           name="POST-TITULO"
                                           class="input-tam form form-control"
                                           placeholder="Insira o Titulo"
                                           required="true">
                                </section>

                                <label class="col-sm-2 col-form-label">Nome Animal:</label>

                                <section class="col m-2">     
                                    <input type="text"
                                           name="POST-NOME-PET"
                                           class="input-tam  form form-control"
                                           placeholder="Nome Animal"
                                           required="true">
                                </section>

                            </section>
                            <section class="row"> 

                                <label class="col-sm-2 col-form-label">Raça Animal:</label>

                                <section class="col m-2">  

                                    <input type="text"
                                           name="POST-RACA-PET"
                                           class="input-tam  form form-control"
                                           placeholder="Raça Animal"
                                           required="true">

                                </section>

                                <label class="col-sm-2 col-form-label">Cor Animal:</label>

                                <section class="col m-2">     
                                    <input type="text"
                                           name="POST-COR-ANIMAL"
                                           class="input-tam  form form-control"
                                           placeholder="Cor Animal"
                                           required="true">
                                </section>

                            </section>

                            <section class="row">     

                                <label class="col-sm-2 col-form-label">Sexo Animal:</label>

                                <select class="form-control m-2" style="width: 200px"
                                        name="POST-SEXO-PET">
                                    <option value="0" checked>Macho</option>>
                                    <option value="1">Fêmea</option>

                                </select>

                                <label class="col-sm-2 col-form-label">Idade Animal:</label>

                                <section class="col m-2">     
                                    <input type="text"
                                           name="POST-IDADE-PET"
                                           class="input-tam  form-control"
                                           placeholder="Idade"
                                           required="true">
                                </section>

                            </section>

                            <section class="row"> 


                                <label class="col-sm-2  col-form-label">Foto Animal:</label>

                                <section class="col m-2">     



                                    <input type="file"
                                           name="CADASTRO-FOTO-ANIMAL"
                                           class="input-tam  form-control"
                                           placeholder=""
                                           required="true">
                                </section>

                                <label class="col-sm-2 col-form-label">Porte Animal:</label>

                                <section class="col m-2"> 


                                    <select class="form-control m-2" style="width: 200px"
                                            name="POST-ANIMAL-PORT">
                                        <option value="0" checked>Grande</option>>
                                        <option value="1">Médio</option>
                                        <option value="2">Pequeno</option>
                                    </select>
                                </section>


                            </section>

                            <label class="col-form-label">Ponto de referencia para localização:</label>

                            <section class="row"> 

                                <section class="col m-2">
                                    <textarea name="POST-ANIMAL-REFERENCIA"></textarea>
                                </section>  

                            </section>
                            <input type="button" class="button_passo2" value="voltar" />
                            <input type="submit" />
                        </div>
                    </div>
                </form>
            </div>


            <?php
//View::getTelaCadastro();
            ?> 
            <div>
                <?php
                MenuNav::footer();
                ?>
            </div>

            <!-- Chamar dependencias javascript -->
            <script src="../Contents/js/site.js"></script>   
            <script src="../Contents/plugins/bootstrap/js/bootstrap.js"></script>
            <script type="text/javascript" src="./Layout/post/dist/summernote-lite.js"></script>
            <script src="./Layout/post/dist/lang/summernote-pt-BR.min.js"></script>

    </body>
</html>
