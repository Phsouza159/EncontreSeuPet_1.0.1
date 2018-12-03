<?php
    include_once __DIR__ . "/../../../NucleoClass/AnuncioDTO.php";
    include_once __DIR__ . "/../../../Model/AnuncioDAO.php";
    include_once __DIR__ . "/../../../Model/Conexao.php";
    
     $Con = new Conexao();
     $Anuncio = AnuncioDAO::BuscarAnuncio($Con->getCon());   
    
    
?>
<div class="body-anuncios" style="background-image: url('../Contents/img/<?php echo $Anuncio->getFotoAnuncio(); ?>')"> 
   <div class="position-anuncios-texto">
       
   </div>
</div>
