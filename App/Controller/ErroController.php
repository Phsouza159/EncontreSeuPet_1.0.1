


<?php
/**
 * Description of ErroController
 *
 * @author paulo-pc
 */
class ErroController {

    public static function erroFatal($mens = " Erro Desconhecido!")
    {
 
        echo "<style>";        
echo " 
   body {
    margin: 0;
    overflow-y: hidden;
   }
  .erro-sombra {
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   position: fixed;
   min-height: 100vh;
   min-widht: 100vh;
   z-index: 1000;
   background-color: rgba( 0 , 0 , 0 , 0.5);

  }
  
  .erro-body
  {
    margin-top: 10%; 
    height: 350px;
    widht: 450px;
    background-color: #A52A2A;
    color: rgba(255,255,255,0.8);
    margin-left: 20%;
    margin-right: 20%;
    padding: 15px;
  }
  .erro-rodape
  {
    margin-left: 20%;
    margin-right: 20%;
    height: 100px;
    widht: 450px;
    background-color: #fff;
    bottom:0;
  }
  
  .erro-rodape button {
   height: 50px;
   widht: 100px;
   color: #fff;
   background-color: #A52A2A;
   border: 3px solid #A52A2A;
   border-radius: 5px;
   z-index: 10001;
   margin-top: 15px;
   margin-left: 47%;
  }
";
  echo "</style>";
echo " 
<div class='erro-sombra'>
  <div class='erro-body'>
    <center>
      <h1>Erro Fatal:</h1> 
      <hr style='color: #fff'>
        </center>
      </br>
       <h2>"
       .$mens.
      "
       </h2>
      </br>

  </div>
        <div class='erro-rodape'>
         <button onclick=\"window.location.href = 'home.php'\">Voltar</button>
      </div>
</div>";

            exit;
        
    }


    //put your code here
}
