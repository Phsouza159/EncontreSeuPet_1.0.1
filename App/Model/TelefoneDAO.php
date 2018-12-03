<?php

include_once __DIR__ . "/../Controller/ErroController.php";

include_once __DIR__ . "/../NucleoClass/TelefoneDTO.php";
include_once __DIR__ . "/Infra/CollectionsQuerys.php";
include_once __DIR__ . "/Infra/DbContextoDAO.php";
include_once __DIR__ . "/Conexao.php";

class TelefoneDAO extends CollectionsQuerys {
    
    public static function SalvarNovoTelefone(TelefoneDTO $Telefone , $Con)
    {
        $Query = "INSERT INTO `telefone` (`ID`, `Ddd`, `Numero`) VALUES (NULL"
                . ", '".$Telefone->getDdd()."'"
                . ", '".$Telefone->getNumero()."')";
        
        try{
            $Con->beginTransaction();
                    
            $Con->exec($Query);
            self::ValidarCommit($Con->commit(), $Con);
            
            return (self::Get_NEXT_ID_AUTO_INCREMENT_TABLE("telefone", $Con) - 1);
            
        } catch (Exception $Con) {
            ErroController::erroFatal("Nao foi possivel salvar o Telefone :: " 
                                      . $Con->getMessage() . ". Na Query ::" . $Query);
        }
    }
    /**
     * 
     */
    public static function EditarTelefone(TelefoneDTO $Telefone , $Con)
    {
        $Query = "UPDATE telefone "
                . "SET Ddd  = " . $Telefone->getDdd()
                . ", Numero = " . $Telefone->getNumero()
                . " WHERE id = " . $Telefone->getId();
        
        try {
            $Con->exec($Query);
            return true;
            
        } catch (Exception $Con) {
            
            echo $Query;
            echo $Con->getMessage();
           
            return false;
        }
    }
    
    public static function getTelefone($Id , $Con)
    {
            try {
            // apelidadno a coluna ID da tabela animal de id PARA ID_ANIMAL ==== cuidado !!!!!
            
            $query = "SELECT * FROM telefone WHERE id = $Id";     
                
            $dbn = $Con->prepare($query);
            $dbn->execute();
            
            
            $values = self::GetTratarValores('default', $dbn );
            if($values  == Null)
            {
                echo "Sem registro";
                return;
            }
            return self::alimentarObjeto($values[0]); // ver controller depos para dois id iguais 
            
        } catch (Exception $exc) {
            
            ErroController::erroFatal('Nao foi possivel buscar post :: ' .$exc->getMessage());
        }
    }
    
    public static function alimentarObjeto($Values)
    {
        return  new TelefoneDTO(
                    $Values['ID']
                    ,$Values['Ddd']
                    ,$Values['Numero']
                );
    }
}
