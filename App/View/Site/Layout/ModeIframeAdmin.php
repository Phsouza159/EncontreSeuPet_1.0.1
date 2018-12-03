<?php
$RESULT = '';
$RETORNO = '';
include_once '../../../Controller/ErroController.php';
include_once '../../../Controller/GetConfigApp.php';
include_once '../../../Model/Infra/CollectionsQuerys.php';
include_once '../../../Model/Infra/DbContextoDAO.php';
include_once '../../../Model/Conexao.php';
include_once '../../../Model/PostDAO.php';
include_once '../../../Model/PessoaDAO.php';
include_once '../../../Model/AnuncioDAO.php';
include_once '../../../NucleoClass/PostDTO.php';


include_once '../../../Controller/FormController.php';

$con = new Conexao();

$OPER = isset($_GET['tipo']) ? $_GET['tipo'] : 'Posst';

switch ($OPER) {
    case 'Pessoa':
        $RESULT = PessoaDAO::getPessoaALL($con->getCon(), true);
        break;

    case 'Post':
        $RESULT = PostDAO::getPostALL($con->getCon(), true);
        break;

    case 'Animal':
        $RESULT = AnimalDAO::getAnimalALL($con->getCon());
        break;
    
    case 'CONTROLE_SCRIPTS':
        break;
    
    case 'ANUNCIOS':
        $RESULT = AnuncioDAO::getAnunciosALL($con->getCon());
        break;
    
    case 'CONTROLE_ANUNCIOS':
       $RESULT = AnuncioDAO::getParaAprovacao($con->getCon());
        break;
    
    default:
        $RESULT = null;
}
?>
<html>
    <head>
        <meta name = "viewport" content = "width=device-width">
        <link rel = "stylesheet" type = "text/css" href = "../../Contents/plugins/bootstrap/css/bootstrap.css">
        <link rel="stylesheet/less" type="text/" href="../../Contents/css/Anuncios.less">
        <script type="text/javascript" src="../../Contents/plugins/less/dist/less.min.js"></script> 
        
        <style>
        table td{
        font-size: 12px;
        border-bottom: 1px solid gray;
        }
        table th {
        background-color: black;
        color: white;
        }

        input {
        background-color: rgba(0, 0, 0, 0);
        border: 0px;
        border-bottom: 1px solid gray;
        color: black!important;
        }

        </style>
        <script>


        function ativarEdicao(elemento){
        // var elemento = document.getElementsByClassName('input-crud');
        // for(var x = 0 ; x < elemento.count)
        var input = elemento.querySelectorAll('input');
        input[0].autofocus = true;
        input[0].style.borderBottom = "1px solid red";
        input[0].disabled = false;
        };

        function submitF(id){

        // elemento = document.getElementsByClassName(id);
        // var e = elemento[0].querySelectorAll('form');
        //e.submit;
        document.getElementsByClassName("form1").submit();
        //submit();
        //elemento.submit
        //
                    };
        </script>   
    </head>

    <body>
    <?php
    
    if($OPER == 'ANUNCIOS')
    {
        if(count('$RESULT') == 0)
        {
            echo "<p class='h1'>Sem registros</p><br/><hr/>";
            exit;
        }
        
        foreach ($RESULT as $Anuncio) {
            
       
            echo "<section class='col'> 
                      <hr/>
                  </section>";
            
              echo "<div class='row m-3'>
                      
                 <form action=\"ModeIframeAdmin.php?tipo=CONTROLE_SCRIPTS\" method=\"post\">
                    <label class='m-5'>Excluir anúncio:</label>
                    <input type=\"hidden\" name=\"ACAO_FORM\" value=\"Excluir_Anuncio\">
                    <input type=\"hidden\" name='Anuncio-Id' value='".$Anuncio->getId()."' />
                    <button class='btn btn-danger' >Excluir</button>
                    
                 </form>    
                  </div>";

              echo "<div class=\"body-anuncios\" style=\"background-image: url('../../Contents/img/". $Anuncio->getFotoAnuncio() . "')\" 
                          <div class=\"position-anuncios-texto\">
       
                        </div>
                     </div>
                    <hr/> 
                    ";
         }      
         exit;
    }
    
    
    if($OPER == 'CONTROLE_ANUNCIOS')
    {
        // quer mudar algo ou ta falta algo ? na sua visao ?acho que tá 10 de 10 kkkk 
        if(count($RESULT) == 0)
        {
            echo "<p class='h1'>Sem registros</p><br/><hr/>";
            exit;
        }
        
        
        for($x = 0 ; $x < count($RESULT) ; $x++)
        {
            
            $Patrocinador =  $RESULT[$x];
                //print_r($Anuncio);
            
            $Anuncio = $Patrocinador->getANUNCIO();
                
            echo   "
                <hr/>
                <div class=\"row\" style='m-5'>
               
                <section class='col'>
                
                    <p class='h1'>Patrocinador</p>

                    <ul class=\"descricao-pet\">
                        <li>Nome: ". $Patrocinador->getNome() . "</li>
                        <li>Sobrenome: ". $Patrocinador->getSobrenome() . "</li>
                        <li>Telefone: (61) ".$Patrocinador->getTelefone()->getNumero()." </li>
                    </ul>
                </section>
                
                <section class='col'>    
                
                    <p class='h1'>Empresa</p>

                    <ul class=\"descricao-pet\">
                        <li>Nome Empresa: ". $Patrocinador->getNome() . "</li>
                        <li>Email Empresa: ". $Patrocinador->getSobrenome() . "</li>
                        <li>Telefone Empresa: </li>
                    </ul>
                </section>
    
            </div>";
            
            
             echo "<section class='col'> 
                        <p class='h3'></p>
                    </section>";
            
            
              echo "<div class='row m-3'>

                 <form action=\"ModeIframeAdmin.php?tipo=CONTROLE_SCRIPTS\" method=\"post\">
            
                    <input type=\"hidden\" name=\"ACAO_FORM\" value=\"ATUALIZAR_Anuncio\">
                    <input type=\"hidden\" name='Anuncio-Id' value='".$Anuncio->getId()."' />
                    <button class='btn btn-primary' >Aprovar</button>
                    
                 </form>
                        <label class='m-5'></label>
                 <form action=\"ModeIframeAdmin.php?tipo=CONTROLE_SCRIPTS\" method=\"post\">
            
                    <input type=\"hidden\" name=\"ACAO_FORM\" value=\"ATUALIZAR_Anuncio\">
                    <input type=\"hidden\" name='Anuncio-Id' value='".$Anuncio->getId()."' />
                    <button class='btn btn-danger' >Excluir</button>
                    
                 </form>    
                 
                  </div>";

              echo "<div class=\"body-anuncios\" style=\"background-image: url('../../Contents/img/". $Anuncio->getFotoAnuncio() . "')\" 
                          <div class=\"position-anuncios-texto\">
       
                        </div>
                     </div>
                    <hr/> 
                    ";
            

            
        }
        
        
        
        exit;
    }
    
    
    
    if($OPER == "CONTROLE_SCRIPTS")
    {
        $SQL = isset($_REQUEST['SCRIPT_TEXTO']) ? $_REQUEST['SCRIPT_TEXTO'] : "";
    
          echo "
            <div class=\"form-group\">
            <form action=\"ModeIframeAdmin.php?tipo=CONTROLE_SCRIPTS\" method=\"post\">
            
                <input type=\"hidden\" name=\"ACAO_FORM\" value=\"ATUALIZAR_SCRIPT\">
                
                <label for=\"comment\">SCRIPT SQL:</label>
                <textarea class=\"form-control\" rows=\"5\" id=\"comment\" name=\"SCRIPT_TEXTO\">$SQL</textarea>
                <input type=\"submit\"></input>
            </form>
         </div>
         "; 

       if($RETORNO != null && is_array($RETORNO))
        {
           
            $linhas = count($RETORNO);
            $ColunasNomes = array_keys($RETORNO['0']);
            $qntDeColunas = count($RETORNO);
           
            echo "<table class='table table-responsive-lg text-center'>";
                echo "<tr>";

                    foreach ($ColunasNomes as $th) {
                        echo "<th>" . $th . "</th>";
                    }
                    echo "</tr>";
                    foreach ($RETORNO as $Chave) {
                        echo "<tr>";
                            foreach ($Chave as $td) {
                                $td = is_null($td) ? " - " : $td;

                                echo "<td>" . $td . "</td>";
                            }
                        echo "</tr>";
                    }

            echo "</table>";

        } else if (is_string($RESULT)) {
            echo $RETORNO;
        }
        exit;
    }
    
    
    if($RESULT == null)
    {
        echo "sem registros Ativos!";
    }
    else   
    {
        
        
        $linhas = count($RESULT);
        $ColunasNomes = array_keys($RESULT['0']);

    echo "<table class='table table-responsive-lg text-center'>\n";
        echo "<tr>";

            foreach ($ColunasNomes as $th) {
            echo "<th>" . $th . "</th>\n";
            }
            echo "<td colspan='3'>Ações</td>\n";

            echo "</tr>\n";

     foreach ($RESULT as $Celula) {

        $id = $Celula["ID"];
        $x = 0;

        echo "<tr>\n";
            echo "<form class='form".$id."' method='POST' action=''>\n";
                echo "<input type='hidden' name='ACAO_FORM' value='ALTERACAO-ADMIN'>";

                
                $NameColunasInput = '';
                
                foreach ($Celula as $td) {
                $td = is_null($td) ? " - " : $td;

                    if($x != 0)
                    {
                     echo "<td onclick='ativarEdicao(this, \"form".$id."\")' >\n"
                        . "<input name='".$ColunasNomes[$x]."'  class='grup controler-grup input-crud'type='texto' value='" . $td . "'/>"
                        . "\n</td>\n";  
                    }   
                     else
                    {   
                         echo "<input type='hidden' name='".$ColunasNomes[$x]."' value='".$td."'/>";
                         echo "<td>".$td."</td>";
                    }
                        
                    $x++;
                }
                
                echo "<td><a><input type='submit' value='Salvar' style='border: 0px; color: blue'></input></a></td>";
                //echo "<td><a href='#' onclick='submitF(\"form".$id."\")'>Editar</a></td>\n";
                echo "</form>\n";
            echo "<td><a href='./TABELA_POTS.php?ACAO_FORM=EXCLUIR_POST&excluirId=".$Celula['ID']."'>Excluir</td>\n";
        echo "</tr>\n";
     }
    echo "</table>";
}
?>
</body>
</html>
