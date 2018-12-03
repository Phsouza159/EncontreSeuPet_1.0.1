<?php

include_once __DIR__ . '/Infra/CollectionsQuerys.php';

class AnimalDAO extends CollectionsQuerys {
  
    public static function SetNovoAnimal(AnimalDTO $Animal = null, $con = null) {
        $con->beginTransaction();
            
        $query = "INSERT INTO `animal` (`ID`, `TipoAnimal`, `NomePet`, `PortePet`, `RacaPet`, `CorPet`, `SexoPet`, `IdadePet`, `FotoPet`, `Ativo`, `POST_ID`, `PESSOA_ID`) 
                  VALUES ( NULL
                   , ".$Animal->getTipoAnimal()
                . ", '".$Animal->getNomePet()   ."'"
                . ",  ".$Animal->getPortePet()
                . ", '".$Animal->getRacaPet()   ."'"
                . ", '".$Animal->getCorPet()    ."'"
                . ", '".$Animal->getSexo()      ."'"
                . ",  ".$Animal->getIdadePet()
                . ", '".$Animal->getFotoPet()   ."'"
                . ",  ".$Animal->getAtivo()
                . ",  ".$Animal->getPOST()
                . ",  ".$Animal->getPESSOA()->getId().");"; 
  
        try {

            $con->exec($query);
            self::ValidarCommit($con->commit(), $con);
            return (self::Get_NEXT_ID_AUTO_INCREMENT_TABLE('Animal' , $con) - 1);

        } catch (PDOException $con) {
            ErroController::erroFatal("Nao foi possivel salvar o animal na base de dados: Querey -> " . $query . " erro :" . $con->getMessage() );
        }
    }
    
    public static function quantidadeAnimal($con){
        parent::VerificarParametros('Default', $con , 'Quantidade de Animal');
        
        try {
            
            $query = "SELECT COUNT(id) FROM animal";
            
            $dbn = $con->prepare($query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            return $count[0]['COUNT(id)'];
            
            
        } catch (Exception $exc) {
            ErroController::erroFatal("Nao foi possivel carregar quantidade de animais(quantidadeAnimal) :: " . $exc->getMessage());          
        }
    }
        public static function getAnimalALL( $con)
    {
                parent::VerificarParametros('Default', $con , 'Buscar todos os posts');
        
        try {
            
            $query = "SELECT * FROM animal ORDER BY id DESC";
            
            $dbn = $con->prepare($query);
            $dbn->execute();
            return self::GetTratarValores('default', $dbn );
            
        } catch (Exception $exc) {
            
           ErroController::erroFatal("Nao foi possivel carregar tabela com todos os Animais :: " . $exc->getMessage()); 
        }
    }
    
    
    public static function GetAnimal($id , $con)
    {
         
         $query = "SELECT * FROM Animal WHERE ID = " . $id;
         
       try {
            $dbn = $con->prepare($query);
            $dbn->execute();
        } catch (PDOException $con) {
            ErroController::erroFatal("Nao foi possivel salvar o animal na base de dados: Querey -> " . $query . " erro :" . $con->getMessage() );
        } 
            $values = parent::GetTratarValores('default', $dbn );
            if(empty($values))
            {
                return "Pots sem animal";
            }
                       
            //echo "<pre>";
            //  print_r($values);
            //echo "</pre>";
            return self::alimentarAnimalDados(new AnimalDTO() , $values[0]);
        
    }
    public static function  EditarAnimal(AnimalDTO $Animal , $Con)
    {
        $Query = "UPDATE animal "
                . "SET TipoAnimal = " . $Animal->getTipoAnimal()
                . ",NomePet = '" . $Animal->getNomePet()  . "'"
                . ",PortePet =  " . $Animal->getPortePet()
                . ",RacaPet = '" . $Animal->getRacaPet()  . "'"
                . ",CorPet  = '" . $Animal->getCorPet()   . "'"
                . ",SexoPet = '" . $Animal->getSexo()     . "'"
                . ",IdadePet=  " . $Animal->getIdadePet()
                . ",FotoPet = '" . $Animal->getFotoPet()  . "'"
                . ",Ativo   =  " . $Animal->getAtivo()
                . ",POST_ID =  " . $Animal->getPOST()       
                . ",PESSOA_ID =" . $Animal->getPESSOA()
                . " WHERE ID = " . $Animal->getId();
        try {
            $Con->exec($Query);
            return true;
            
        } catch (Exception $Con) {
            
            echo $Query;
            echo $Con->getMessage();
           
            return false;
        }
     }


    
    private static function alimentarAnimalDados(AnimalDTO $Animal ,array $values) : AnimalDTO
    {
        //echo "<pre>";
        //    print_r($values);
        //echo "</pre>";
     
        try{
           $Animal->setId($values['ID']);
           $Animal->setTipoAnimal($values['TipoAnimal']);
           $Animal->setNomePet($values['NomePet']);
           $Animal->setPortePet($values['PortePet']);
           $Animal->setRacaPet($values['RacaPet']);
           $Animal->setCorPet($values['CorPet']);
           $Animal->setSexo($values['SexoPet']);
           $Animal->setIdadepet($values['IdadePet']);
           $Animal->setFotoPet($values['FotoPet']);
           $Animal->setAtivo($values['Ativo']);
           $Animal->setPOST($values['POST_ID']);
           $Animal->setPESSOA($values['PESSOA_ID']);
           
           return $Animal;
        }
        catch (Exception $Animal)
        {
            ErroController::erroFatal("Não Foi possivel recuperar valores para a classe Animal :: " . $Animal->getMessage());
        }
    }
    
}
?>