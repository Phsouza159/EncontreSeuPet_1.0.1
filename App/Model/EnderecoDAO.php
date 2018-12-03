<?php
include_once __DIR__ . "/../NucleoClass/EnderecoDTO.php";
include_once __DIR__ . "/Infra/CollectionsQuerys.php";
include_once __DIR__ . "/Infra/DbContextoDAO.php";
include_once __DIR__ . "/Conexao.php";
/*
 */
class EnderecoDAO extends CollectionsQuerys {
    
    public static function SetNovoEndereco(EnderecoDTO $Endereco , $Con)
    {
        $Con->beginTransaction();
        
        $Query = "INSERT INTO `endereco` (`ID`, `CEP`, `Endereco`, `Complemento`, `UF`) "
                . "VALUES (NULL, '".$Endereco->getCEP()."'"
                . ", '".$Endereco->getEndereco()."'"
                . ", '".$Endereco->getComplemento()."'"
                . ", '".$Endereco->getUF()."')";
        try{
            
            $Con->exec($Query);
            self::ValidarCommit($Con->commit(), $Con);
            
            return (self::Get_NEXT_ID_AUTO_INCREMENT_TABLE("endereco", $Con) - 1);
            
        } catch (Exception $Con) {
            ErroController::erroFatal("Nao foi possivel salvar o endereco :: " 
                                      . $Con->getMessage() . ". Na Query ::" . $Query);
        }
    }
    
    public static function EditarEndereco(EnderecoDTO $Endereco , $Con)
    {
        $Query = "UPDATE endereco "
                . "SET CEP = " . $Endereco->getCEP()
                . ", Endereco = '" . $Endereco->getEndereco() . "'"
                . ", Complemento = '" . $Endereco->getComplemento() . "'"
                . ", UF = '" . $Endereco->getUF() . "'"
                . "WHERE ID = " . $Endereco->getId();
        try {
            $Con->exec($Query);
            return true;
            
        } catch (Exception $Con) {
            
            echo $Query;
            echo $Con->getMessage();
           
            return false;
        }
    }
    
    public static function getEndereco($Id , $Con)
    {
        try {
            // apelidadno a coluna ID da tabela animal de id PARA ID_ANIMAL ==== cuidado !!!!!
            
            $query = "SELECT * FROM endereco WHERE id = $Id";     
                
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
        return new EnderecoDTO(
                             $Values['ID']
                            ,$Values['CEP']
                            ,$Values['Endereco']
                            ,$Values['Complemento']
                            ,$Values['UF']
                        );
    }
}
