<div class='m-5 col-sm'>
    <center>

        <section class='col-sm p-4 bg-info text-justify' >
            <?php
               $tipo = $post['TipoPost'] == 1 ? "Doacão" : "Perdido";
                echo "<h3 class='card-title'>Tipo do post: $tipo</h2>";
                echo "<h3 class='card-title'>".$post['Titulo']."</h2>";
            ?>
            
            
             <section class='col-sm p-3 '>
                 <center><img src='../Contents/img/<?php echo $post['FotoPet'] ?>' height="250px" width="250px"></center>
        </section>

                <a class='btn btn-light' href='../Posts/<?php echo $post['CaminhoPost'] ?>'>Visualizar post</a> 
                
                <?php 
                    if(isset($_SESSION['SESSION_USER_LOG']))
                    {
                        if($_SESSION['SESSION_USER_LOG']['USER_DADOS']->getTipoPessoa() == 3)
                        {
                            echo "<form action='' method='POST'>    
                                    <input type='hidden' name='ACAO_FORM' value='Excluir_Post'>

                                    <a class='btn btn-danger m-2' type='submit'>Excluir Post</a>

                                  </form>
                             ";
                        }
                    }
                
                ?>
                <p class='card-text'>publicação: <?php echo $post['DtCriacao'] ?></p>
        </section>
        
        
    </center>
</div>