<?php
class MenuNav { 
   public static function menu($camNormal = './') /* primeiro metodo. */ 
   {
       echo "<nav class='navbar navbar-expand-lg navbar-dark bg-info sticky-top'>
        <div class='container '>
            <a class='navbar-brand' href='#'>Encontre seu pet <3</a>

            
            <button class='navbar-toggler' type='button'
                    data-toggle='collapse' data-target='#navbarSiteMenu'>
                    <span class='navbar-toggler-icon'></span>
            </button>


            <div class='collapse navbar-collapse' id='navbarSiteMenu'>

                <ul class='navbar-nav ml-auto'>

                    <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown'>
                          Login
                         </a>
                        <div class='dropdown-menu p-4'  aria-labelledby='navbarDropdown'>
                       ";
                   if(!isset($_SESSION['SESSION_USER_LOG']))
                   {
                        echo "
                          <form method='post'>

                             <input type='hidden'  value='LOGIN' name='ACAO_FORM' />

                                <label>Usuario</label>
                                <input name='USUARIO' class='form-control' style='width: 250px' type='texto' />
                            
                                <br/>
                                <label>Senha</label>
                                <input name='SENHA' class='form-control' type='password' />
                            
                                <br/>
                                <button class='m-1 btn btn-primary'  type='submit'>Login</button>
                            </form>
                                ";
                   }
                    else {
                        echo "Sair da sessão:<a class='btn btn-danger m-3' href='./home.php?acao=sair' >Sair</a>";
                    }
            echo "                        
                        </div>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='".$camNormal."Home.php'>Home</a>
                    </li>
                    
                  
                    <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown'>
                          Galeria Posts
                         </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                          <a class='dropdown-item' href='".$camNormal."Posts.php?tipo=2'>Desaparecidos</a>
                          <a class='dropdown-item' href='".$camNormal."Posts.php?tipo=1'>Adoção</a>
                        </div>
                    </li>
            

                    <li class='nav-item'>
                        <a class='nav-link' href='".$camNormal."CadastroPatrocinador.php'>Patrocinadores</a>
                    </li>
                    ";
        if(isset($_SESSION['SESSION_USER_LOG']))
        {
            $User = $_SESSION['SESSION_USER_LOG']['USER_DADOS'];
            if($User->getTipoPessoa() == 3)
            {
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='".$camNormal."PainelControleAdmin.php'>Administrador</a>
                    </li>
                    ";
            }
        
        
            
            echo "
                    <li class='nav-item'>
                       <b style='color: white'>
                        <a class='nav-link' href='".$camNormal."painelUser.php' id='navbarDropdown'>
                            Usuario: ". $User->getNome() ."
                        </a>
                       </b>
                     </li>
                    ";
             
        }
        
    echo " 
                </ul>
            </div>
        </div>
    </nav>";
   }

   public static function footer() /*segundo metodo */ 
   {
     
       echo "<div class=''>
               <p class='h3 m-2 text-center p-5'>Alguns dos nossos patrocinadores:</p>
              <hr />
<div id='carouselFooter' class='carousel slide' data-ride='carousel'>

  
  <div class='carousel-inner container-fluid'>
    <div class='carousel-item active'>
      " . self::getPatrocinador() . "
    </div>
    <div class='carousel-item'>
      " . self::getPatrocinador() . "
    </div>

    
    
  
 </div>
  <a class='box-nav-carousel-prev' href='#carouselFooter' role='button' data-slide='prev'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='sr-only'>Previous</span>
  </a>
  <a class='box-nav-carousel-next' href='#carouselFooter' role='button' data-slide='next'>
    <span class='carousel-control-next-icon' aria-hidden='true' ></span>
    <span class='sr-only'>Next</span>
  </a>

       
 
  </div>
</div></div>
<div class='p-3' style='background-color: rgb(65 , 64 , 65); font-size: 13px; color: white'>
<center>
<p class=''>© Project - Encontre seu pet - Versão: 2.0.2</p>
<img class='' src='../Contents/img/giphy.webp' style='filter: invert(75%);' width='75px' />
</center>
</div>
";
    }
   public static function getPatrocinador($camNormal = './')
   {
      $aux = "<div class='position-cards'>
              <section class=''>";   
   
      for($i = 0 ; $i < 1; $i++)
      {
          
        $aux .= " 
                <style>
                    .teste-box1::after{
                    content: ' A cada refeição retribuímos um pouco do amor e da dedicação que nossos amigos caninos estão sempre dispostos a dar.PEDIGREE®';
                    }    
                    
                .teste-box2::after{
                    content: ' Estamos orgulhosos por produzir algumas das mais populares e credenciadas marcas de pet food que se comercializam em Portugal.';
                    }   
                    
                .teste-box3::after{
                    content: ' A cada refeição retribuímos um pouco do amor e da dedicação que nossos amigos caninos estão sempre dispostos a dar.PEDIGREE®';
                    }   
                    
                .teste-box4::after{
                    content: ' Whiskas®, além de delicioso, tem um alimento para cada fase da vida do seu gato.';
                    }   
                    
                .teste-box5::after{
                    content: ' A cada refeição retribuímos um pouco do amor e da dedicação que nossos amigos caninos estão sempre dispostos a dar.PEDIGREE®';
                    }   
                    
                </style>
                <div class='col-2 super-box'>
                    <div class='container'>
                        <div class='box-card teste-box1'>

                            <div class=''>   

                            </div>
                        </div>
                        <div class='icon-card'>
 <img class='card-img' src='../Contents/img/Patrocinadores_Cards/pedigree.jpg' alt='Card image' style='border-radius:50%; width: 80px; height: 80px;'>

                            </img>
                        </div>
                    </div>
                    <div class= 'text'>
                    <p class='title'>
                   

                    </p>
                     </div>
                </div>
                


                <div class='col-2 super-box'>
                    <div class='container'>
                        <div class='box-card teste-box2'>

                            <div class=''> 

                            </div>
                        </div>
                        <div class='icon-card'>
 <img class='card-img' src='../Contents/img/Patrocinadores_Cards/DogChower.jpg' alt='Card image' style='border-radius:50%; width: 80px; height: 80px;'>

                            </img>
                        </div>
                    </div>
                    
                </div>
                

                            <div class='col-2 super-box'>
                    <div class='container'>
                        <div class='box-card teste-box3'>

                            <div class=''> 

                            </div>
                        </div>
                        <div class='icon-card'>
 <img class='card-img' src='../Contents/img/Patrocinadores_Cards/Cats.png' alt='Card image' style='border-radius:50%; width: 80px; height: 80px;'>

                            </img>
                        </div>
                    </div>
                    
                </div>
                
                
                 <div class='col-2 super-box'>
                    <div class='container'>
                        <div class='box-card teste-box4'>

                            <div class=''> 

                            </div>
                        </div>
                        <div class='icon-card'>
 <img class='card-img' src='../Contents/img/Patrocinadores_Cards/whiskas.jpg' alt='Card image' style='border-radius:50%; width: 80px; height: 80px;'>

                            </img>
                        </div>
                    </div>
                    
                </div>
                


                <div class='col-2 super-box'>
                    <div class='container'>
                        <div class='box-card teste-box5'>

                            <div class=''> 

                            </div>
                        </div>
                        <div class='icon-card'>
<img class='card-img' src='../Contents/img/Patrocinadores_Cards/estima.jpg' alt='Card image' style='border-radius:50%; width: 80px; height: 80px;'>

                            </img>
                        </div>
                    </div>
                    
                </div>
                


                


            ";
      }
      $aux .= "</section></div>";
      
      return $aux;
   }
   
}
