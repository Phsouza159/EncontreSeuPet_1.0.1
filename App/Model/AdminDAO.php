<?php

include_once __DIR__ . '/../Controller/ErroController.php';

class AdminDAO extends CollectionsQuerys{

    public static function ProcessarScriptSql($script = null , $con = null)
    {
        self::VerificarParametros($script , $con);
        
        try{
            
            $dbn = $con->prepare($script);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            return $count;
            
        } catch (Exception $con) {
            return ("Erro ao execultar script :: " . $script . " -> " . $con->getMessage());
        }
        
    }
    
}
