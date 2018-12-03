<?php
include_once __DIR__ . "/../NucleoClass/TelefoneDTO.php";
include_once __DIR__ . "/Infra/CollectionsQuerys.php";
include_once __DIR__ . "/Infra/DbContextoDAO.php";
include_once __DIR__ . "/Conexao.php";
/*
 
 */
class AcessoDAO extends CollectionsQuerys {
    
    public static function SalvarNovoAcesso(AcessoDTO $Acesso , $Con)
    {
        
        $Query = "INSERT INTO `acesso` (`ID`, `Usuario`, `Senha`) VALUES (NULL"
                . ", '".$Acesso->getUsuario()."'"
                . ", '".$Acesso->getSenha()."')";
        try{
            $Con->beginTransaction();
             
            $Con->exec($Query);
            self::ValidarCommit($Con->commit(), $Con);
            
            return (self::Get_NEXT_ID_AUTO_INCREMENT_TABLE("acesso", $Con) - 1);
            
        } catch (Exception $Con) {
            ErroController::erroFatal("Nao foi possivel salvar o Acesso :: " 
                                      . $Con->getMessage() . ". Na Query ::" . $Query);
        }
    }
}
