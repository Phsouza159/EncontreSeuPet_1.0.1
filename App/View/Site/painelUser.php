<!DOCTYPE html>
<?php

include_once __DIR__ . '/../../Controller/FormController.php';
include_once __DIR__ . '/Layout/MenuNav.php';


if(isset($_SESSION['SESSION_USER_LOG']))
{
    $User = $_SESSION['SESSION_USER_LOG'];
}
 else {
     herder("Location: home.php");
}
echo "<pre>";
    print_r($User);
echo "</pre>";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel</title>
        
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

        </style>
    </head>
    <body>
        <?php
            MenuNav::menu();
        ?>
        
        <div class="container" style="background-color: grey">
            <?php
            
           $Dados = $User['USER_DADOS'];
            
            ?>
            <form action="Cadastro.php" method="POST" enctype="multipart/form-data">

                    <input type='hidden' value='CADASTRO-POST' name='ACAO_FORM' />

                    <div class="passo1">

                        <p class='h1'>Dados Pessoais</p>
                        
                        <div class="row m-2">
                            
                            <section class="col" >  

                                <input id="formCadastroNome"
                                       value="<?php echo $Dados->getNome() ?>"
                                       name='cadastro-nome' 
                                       type='text' 
                                       class='input-principal-cadastro' 
                                       placeholder='Nome...'> 

                                <a class="input-name"></a> 
                                
                            </section>
                            
                            <section class="col">  

                                <input id="formCadastroSobrenome" 
                                       value="<?php echo $Dados->getSobrenome() ?>"
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
                                        value="(<?php echo $Dados->getTelefone()->getDdd() .") " . $Dados->getTelefone()->getNumero() ?>"
                                       name='cadastro-telefone' 
                                       type='text' 
                                       class='input-principal-cadastro' 
                                       placeholder='Telefone...'>

                                <a class="input-telefone"></a> 
                            </section>

                            <section class="col"> 
                                <input id="formCadastroEndereco" 
                                       value="<?php echo $Dados->getEndereco()->getEndereco() ?>"
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
                                       value="<?php echo $Dados->getEndereco()->getCep() ?>"
                                       name='cadastro-CEP' 
                                       type='text' 
                                       class='dtNasc-calendario-group-principal-cadastro'
                                       placeholder='CEP...'/>
                                       
                            </section> 
                            
                            
                            <section class="col">
                                <input id=""
                                       value="<?php echo $Dados->getEndereco()->getComplemento() ?>"
                                       name='cadastro-Complemento' 
                                       type='text' 
                                       class='dtNasc-calendario-group-principal-cadastro'
                                       placeholder='Complemento...'/>
                                       
                            </section> 
                            
                            <section class="col"> 

                                <label>Data de Nacimento:</label>
                                <br />
                                <input id="formCadastroDtNascimento"
                                       value="<?php echo $Dados->getDtnascimento() ?>"
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
                                       <?php if($Dados->getSexo() == 'm') echo "checked"; ?>
                                       >
                                       
                                <span class='text-descricao-group-principal-cadastro' >Masculino</span> 

                                <input type='radio' 
                                       name='cadastro-sexo' 
                                       value='f'
                                       <?php if($Dados->getSexo() == 'f') echo "checked"; ?>
                                       >
                                <span class='text-descricao-group-principal-cadastro'>Feminino</span> 

                                <input type='radio' 
                                       name='cadastro-sexo'
                                        <?php if($Dados->getSexo() == 'o') echo "checked"; ?>
                                       value='o'>
                                <span class='text-descricao-group-principal-cadastro'>outro</span> 

                            </section>
                            
                        </div>
                    </div>

                    <div class="passo2 p-5" style='width: 350px'>
                        
                        <p class='h1'>Dados Login</p>

                        <br>

                        <label></label>
                        <input name='cadastro-login' 
                               type='text' class='input-principal-cadastro' 
                               value="<?php echo $Dados->getAcesso()->getUsuario() ?>"
                               placeholder='Login'> 
                        <br>
                        <label></label>
                        <input name='cadastro-senha' 
                               type='password' 
                               value="<?php echo $Dados->getAcesso()->getSenha() ?>"
                               class='input-principal-cadastro' 
                               placeholder='Senha'> 

                        <br>

                        <label></label>
                        <input name='cadastro-senha-confirmação' 
                               type='password' 
                               value="<?php echo $Dados->getAcesso()->getSenha() ?>"
                               class='input-principal-cadastro' 
                               placeholder='Confirmar Senha'> 

                        <br>
                    </div>

             <?php
                if($Dados->getTipoPessoa() == 1)
                {
                    getAnimal($Dados);
                }
                if($Dados->getTipoPessoa() == 2)
                {
                    
                }
             ?>       
                    
                  <a class='btn btn-primary' type='submit'>Alterar</a>
            </form>
             <section class='m-5'></section>
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
<?php 

function getAnimal($Dados)
{
    echo " 
                 <div class=\"passo3\">
                        <div id=\"formularioPrincipal\">


                            <label class=\"col-sm-2 col-form-label\\>Tipo Pet:</label>

                            <section class=\"col m-2\"> 

                                <select class=\"form-control m-2\" style=\"width: 200px\"
                                        name=\"POST-ANIMAL-TIPO\">
                                    <option value=\"0\" ";
    
                                      if($Dados->getAnimal()->getTipo == 0)
                                           echo "checked";
                                      
                                      echo "
                                            >Gato</option>>
                                    <option value=\"1\"
                                         <?php if($Dados->getAnimal()->getTipo == 1) echo \"checked\"; ?>   
                                            >Cachorro</option>
                                </select>
                                
                            </section>

                            <section class=\"row\"> 

                                <input id='tipoPostValor' type='hidden' value='1' name='TIPO-POST'>

                                <label class=\"col-sm-2 col-form-label\">Insira o Titulo:</label>

                                <section class=\"form-group col m-2\">     
                                    <input type=\"text\"
                                           name=\"POST-TITULO\"
                                           class=\"input-tam form form-control\"
                                           placeholder=\"Insira o Titulo\"
                                           required=\"true\">
                                </section>

                                <label class=\"col-sm-2 col-form-label\">Nome Animal:</label>

                                <section class=\"col m-2\">     
                                    <input type=\"text\"
                                           name=\"POST-NOME-PET\"
                                           class=\"input-tam  form form-control\"
                                           placeholder=\"Nome Animal\"
                                           required=\"true\">
                                </section>

                            </section>
                            <section class=\"row\"> 

                                <label class=\"col-sm-2 col-form-label\">Raça Animal:</label>

                                <section class=\"col m-2\">  

                                    <input type=\"text\"
                                           name=\"POST-RACA-PET\"
                                           class=\"input-tam  form form-control\"
                                           placeholder=\"Raça Animal\"
                                           required=\"true\">

                                </section>

                                <label class=\"col-sm-2 col-form-label\">Cor Animal:</label>

                                <section class=\"col m-2\">     
                                    <input type=\"text\"
                                           name=\"POST-COR-ANIMAL\"
                                           class=\"input-tam  form form-control\"
                                           placeholder=\"Cor Animal\"
                                           required=\"true\">
                                </section>

                            </section>

                            <section class=\"row\">     

                                <label class=\"col-sm-2 col-form-label\">Sexo Animal:</label>

                                <select class=\"form-control m-2\" style=\"width: 200px\"
                                        name=\"POST-SEXO-PET\">
                                    <option value=\"0\" checked>Macho</option>>
                                    <option value=\"1\">Fêmea</option>

                                </select>

                                <label class=\"col-sm-2 col-form-label\">Idade Animal:</label>

                                <section class=\"col m-2\">     
                                    <input type=\"text\"
                                           name=\"POST-IDADE-PET\"
                                           class=\"input-tam  form-control\"
                                           placeholder=\"Idade\"
                                           required=\"true\">
                                </section>

                            </section>

                            <section class=\"row\"> 


                                <label class=\"col-sm-2  col-form-label\">Foto Animal:</label>

                                <section class=\"col m-2\">     



                                    <input type=\"file\"
                                           name=\"CADASTRO-FOTO-ANIMAL\"
                                           class=\"input-tam  form-control\"
                                           placeholder=\"\"
                                           required=\"true\">
                                </section>

                                <label class=\"col-sm-2 col-form-label\">Porte Animal:</label>

                                <section class=\"col m-2\"> 



                                    <select class=\"form-control m-2\" style=\"width: 200px\"
                                            name=\"POST-ANIMAL-PORT\">
                                        <option value=\"0\" checked>Grande</option>>
                                        <option value=\"1\">Médio</option>
                                        <option value=\"1\">Pequeno</option>
                                    </select>
                                </section>


                            </section>

                            <label class=\"col-form-label\">Ponto de referencia para localização:</label>

                            <section class=\"row\"> 

                                <section class=\"col m-2\">

                                    <textarea>
                                    </textarea>
                                </section>  

                            </section>
                            <input type=\"button\" class=\"button_passo2\" value=\"voltar\" />
                            <input type=\"submit\" />
                        </div>
                    </div>
    
       ";
    
}
