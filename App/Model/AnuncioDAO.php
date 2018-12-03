<?php

class AnuncioDAO extends CollectionsQuerys{
    /**
     * 
     * @param type $Patrocinador
     * @param Exception $Con
     * @return type
     */
    public static function SalvarNovoAnuncio($Patrocinador , $Con)
    {
        
        $Anuncio = $Patrocinador->getAnuncio();
        
        $Query = "INSERT INTO `anuncio` (`NomeEmpresa`, `IdTelefoneEmpresa`,`EmailEmpresa`,`DtCriacao`, `HrCriacao`, `FotoAnuncio`, `Ativo`, `Aprovado`) "
                . "VALUES ("
                . "  '".$Patrocinador->getNomeEmpresa()."'"
                . ",  ".$Patrocinador->getIdTelefone()
                . ", '".$Patrocinador->getEmailEmpresa()."'"
                . ", '".$Anuncio->getDtCriacao()."'"
                . ", '".$Anuncio->getHrCriacao()."'"
                . ", '".$Anuncio->getFotoAnuncio()."'"
                . ",  1"
                . ",  ".$Anuncio->getAprovado().")";
        try{
            $Con->exec($Query);
            return (self::Get_NEXT_ID_AUTO_INCREMENT_TABLE("anuncio" , $Con) - 1); 
            
        } catch (Exception $Con) {
            ErroController::erroFatal("Erro nao foi possivel salvar o anuncio :: " . $Query . " -- " . $Con->getMessage());
        }
    }
    /**
     * 
     * @param type $Con
     * @return string
     */
    public static function quantidadeAprovado($Con)
    {
        try {
            $query = "SELECT COUNT(id) FROM anuncio WHERE aprovado = 1;";
            
            $dbn = $Con->prepare($query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            return $count[0]['COUNT(id)'];
            
        } catch (Exception $Con) {
            ErroController::erroFatal("nao foi possivel pegar a quantidade de anuncios aprovados :: " . $Con->getMessage());
        }
    }
    /**
     * 
     * @param Exception $Con
     * @return type
     */
    public static function quantidadeParaAprovacao($Con)
    {
        try {
            $query = "SELECT COUNT(id) FROM anuncio WHERE aprovado = 0;";
            
            $dbn = $Con->prepare($query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            return $count[0]['COUNT(id)'];
            
        } catch (Exception $Con) {
            ErroController::erroFatal("nao foi possivel pegar a quantidade de anuncios para aprovacao :: " . $Con->getMessage());
        }
    }
    
    /**
     * 
     * @param type $Con
     */
    public static function  getAnunciosALL($Con)
    {
        try {
            $dbn = $Con->prepare("SELECT * FROM anuncio WHERE ativo = 1");
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            
            $anuncios = array();
            for($x = 0 ; $x < count($count) ; $x++)
            {
                $anuncios[] = self::AlimentarObjeto($count[$x]);
            }
            return $anuncios;
            
        } catch (Exception $Con) {
            ErroController::erroFatal("Nao foi possivel buscar os anuncios :: " . $Con->getMessage());
        }
    }
    /**
     * 
     * @param Exception $Con
     * @return type
     */
    public static function BuscarAnuncio($Con)
    {
        $Query = "SELECT ID FROM anuncio where ativo = 1 && aprovado = 1;";
           try{
            $dbn = $Con->prepare($Query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            $Id = array();
            
            foreach ($count as $value) {
                $Id[] = $value['ID'];
            }
            asort($Id);
            
            $id = rand(0 , (count($Id) - 1));
            
            $dbn = $Con->prepare("SELECT * FROM anuncio WHERE ID = " . $Id[$id]);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
           
            return self::AlimentarObjeto($count[0]);
            
            }   
           catch (Exception $Con) {

           }
    }
    /**
     * 
     * @param type $id
     * @param Exception $Con
     */
    public static function Aprovar($id , $Con)
    {
        try {
            $dbn = $Con->prepare("UPDATE anuncio SET aprovado = 1 WHERE id = $id");
            $dbn->execute();
            
        } catch (Exception $Con) {
            ErroController::erroFatal("Nao foi possivel aprovar o anuncio :: " . $Con->getMessage());
        }
    }
    /**
     * 
     * @param type $Id
     * @param type $Con
     */
    public static function  Excluir($Id , $Con)
    {
        try {
            $dbn = $Con->prepare("UPDATE anuncio SET ativo = 0 WHERE id = $Id");
            $dbn->execute();
            
        } catch (Exception $Con) {
            ErroController::erroFatal("Nao foi possivel excluir o anuncio :: " . $Con->getMessage());
        }
    }
    /**
     * 
     * @param type $Con
     * @return type
     */
    public static function getParaAprovacao($Con)
    {
        $Query = "select * , p.ID as PESSOA_ID from pessoa p inner join anuncio a on p.ANUNCIO_ID = a.ID WHERE a.aprovado = 0";
        
        try {
            
            $dbn = $Con->prepare($Query);
            $dbn->execute();
            
            $count = self::GetTratarValores('default', $dbn );
            $Anuncio = array();
            
            for($x = 0 ;  $x < count($count) ; $x++)
            {
               $Anuncio[]= self::AlimentarObjetoPatrocinador($count[$x] , $Con);
            }
            return $Anuncio;
            
        } catch (Exception $exc) {
            
        }
    }
    /**
     * 
     * @param type $Values
     * @return \AnuncioDTO
     */
    public static function AlimentarObjeto($Values)
    {
        $Anuncio = new AnuncioDTO(
                 $Values['ID']
                ,$Values['DtCriacao'] 
                ,$Values['HrCriacao'] 
                ,$Values['FotoAnuncio']
                ,$Values['Ativo']
                ,$Values['Aprovado']);
        
       return $Anuncio;
    }
    /**
     * 
     * @param type $Values
     * @param type $Con
     * @return type
     */
    public static function AlimentarObjetoPatrocinador($Values , $Con )
    {
        $Anuncio = new AnuncioDTO(
                 $Values['ID']
                ,$Values['DtCriacao'] 
                ,$Values['HrCriacao'] 
                ,$Values['FotoAnuncio']
                ,$Values['Ativo']
                ,$Values['Aprovado']);
        
        $Patrocinador = PessoaDAO::getPessoa($Values["PESSOA_ID"] , $Con);
        
        $Patrocinador->setEmailEmpresa($Values['EmailEmpresa']);
        $Patrocinador->setTelefone( TelefoneDAO::getTelefone( $Values['IdTelefoneEmpresa'], $Con));
        $Patrocinador->setNomeEmpresa("NomeEmpresa");
        $Patrocinador->setAnuncio( $Anuncio );
        
       return $Patrocinador;
    }
}
