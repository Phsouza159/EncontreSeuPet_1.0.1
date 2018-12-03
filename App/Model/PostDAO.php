<?php
/**

 */
include_once __DIR__ . "/Infra/CollectionsQuerys.php";
include_once __DIR__ . "/PessoaDAO.php";
include_once __DIR__ . "/../NucleoClass/PessoaDTO.php";



class PostDAO extends CollectionsQuerys {
   /**
    * 
    * @param PostDTO $post
    * @param PDOException $con
    * @return int
    */
    public static function salvePost(PostDTO $post, $con){ // salvar um post no banco de dados
       
        $con->beginTransaction(); //função do PDO,desliga o comiti.  
             
        $query = "INSERT INTO `post` (`TipoPost`,`Titulo` , `DtCriacao` ,`HrCriacao` , `Ativo` , `CaminhoPost` , `Referencia`)"
                 ." VALUES (" . 
                        $post->getTipoPost()  
                . ", '".$post->getTitulo()    ."'"
                . ", '".$post->getDtCriacao()    ."'"
                . ", '".$post->getHrCriacao()   ."'"
                . ", ".$post->getAtivo() ." "
                . ", '".$post->getCaminhoPost() ."' "
                . ", '".$post->getReferencia()."')";
        try {

            $con->exec($query);
            self::ValidarCommit($con->commit(), $con);//verificação se deu certo o comiti
            
            $id = (self::Get_NEXT_ID_AUTO_INCREMENT_TABLE("post", $con) - 1 );
            
            if($id <= 0 )
                 return 1;
            
            return $id;
            
        } catch (PDOException $con) {
            ErroController::erroFatal("Nao foi possivel criar o novo post :: " . $con->getMessage() . " :: sql :: " . $query);
        }
    }
    /**
     * 
     * @param PostDTO $post
     * @param PDOException $con
     */
    public static function editarPost(PostDTO $post = null , $con = null)
    {
        $con->beginTransaction(); //função do PDO,desliga o comiti.  
             
        $query = "UPDATE post set `tipoPost`         =  ". $post->getTipoPost()  
                                  .",`Titulo`         = '". $post->getTitulo()     . "'"
                                  .",`DtCriacao`      = '" .$post->getDtCriacao()  ."'"
                                  .",`HrCriacao`      = '".$post->getHrCriacao()   ."'"
                                  .",`Ativo`          =  ".$post->getAtivo()       
                                  .",`CaminhoPost`    = '".$post->getCaminhoPost() ."'"
                                  ." where id = " . $post->getId();
        
        try {

            $con->exec($query);
            self::ValidarCommit($con->commit(), $con);//verificação se deu certo o comiti
            
        } catch (PDOException $con) {
            ErroController::erroFatal("Nao foi possivel editar o post atual :: " . $con->getMessage() . " :: sql :: " . $query);
        }
    }
    /**
     * 
     * @param type $id
     * @param PDOException $con
     */
    public static function inativarPost($id = null , $con = null)
    {
        $con->beginTransaction(); //função do PDO,desliga o comiti.  
             
        $query = "UPDATE post set `Ativo` = 0 where id = " . $id;
        
        try {

            $con->exec($query);
            self::ValidarCommit($con->commit(), $con);//verificação se deu certo o comiti
            
        } catch (PDOException $con) {
            ErroController::erroFatal("Nao foi possivel criar o novo pots :: " . $con->getMessage() . " :: sql :: " . $query);
        }
    }
    /**
     * 
     * @param type $con
     * @return type
     */
    public static function quantidadePost($con){
         
        try {
            
            $query = "SELECT COUNT(ativo) FROM post WHERE ativo = 1;";
            
            $dbn = $con->prepare($query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            return $count[0]['COUNT(ativo)'];
            
            
        } catch (Exception $exc) {
            
          //  echo $exc->getTraceAsString();
        }
    }
    /**
     * 
     * @param type $con
     * @param type $SomentePost
     * @return type
     */
    public static function getPostALL( $con , $SomentePost = false, $tipo = 1)
    {
             
        try {
            if($SomentePost)
            {
                $query = "SELECT * FROM post WHERE ativo = 1";
            }
            else
            {
                 $query = "SELECT * FROM post p left join animal a on p.id = a.POST_ID where p.Ativo = 1 and p.TipoPost = $tipo ORDER BY p.id DESC " ;
            }
            
            $dbn = $con->prepare($query);
            $dbn->execute();
            
            return self::GetTratarValores('default', $dbn );
            
        } catch (Exception $exc) {
            
           ErroController::erroFatal('Nao foi possivel buscar todos os posts :: ' . $exc->getMessage());
        }
    }
    /**
     * 
     * @param type $id
     * @param type $con
     * @return type
     */
    public static function getPost($id , $con)
    {
        try {
            // apelidadno a coluna ID da tabela animal de id PARA ID_ANIMAL ==== cuidado !!!!!
            $query = "select *, a.Id as ID_ANIMAL , pp.Id as ID_PESSOA from post p left join Animal a on a.POST_ID = p.Id left join pessoa pp on pp.POST_ID = p.id where p.Ativo = 1 && p.id = $id";
            
            $dbn = $con->prepare($query);
            $dbn->execute();
            
            
            $values = self::GetTratarValores('default', $dbn );
            if($values  == Null)
            {
                echo "Sem registro";
                return;
            }
            return self::alimentarPostDados( new PostDTO() , $values[0] , $con); // ver controller depos para dois id iguais 
            
        } catch (Exception $exc) {
            
            ErroController::erroFatal('Nao foi possivel buscar post :: ' .$exc->getMessage());
        }
    }
  /**
   * 
   * @param PostDTO $post
   * @param array $values
   * @param type $con
   * @return \PostDTO
   */
    private static function alimentarPostDados(PostDTO $post ,array $values , $con) : PostDTO
    {
       try{
          $post->setId($values['ID']);
          $post->setTipoPost($values['TipoPost']);
          $post->setTitulo($values['Titulo']); 
          $post->setDtCriacao($values['DtCriacao']);
          $post->setHrCriacao($values['HrCriacao']);
          $post->setAtivo($values['Ativo']);
          $post->setReferencia($values['Referencia']);
          
          $post->setCaminhoPost($values['CaminhoPost']);
          $post->setPessoa(PessoaDAO::getPessoa( $values['ID_PESSOA'] , $con));
          $post->setANIMAL( AnimalDAO::GetAnimal($values['ID_ANIMAL'] , $con) );
           return $post;
        }
        catch (Exception $post)
        {
            ErroController::erroFatal("Não Foi possivel recuperar valores para a classe Post :: " . $post->getMessage());
        }
    }
}
