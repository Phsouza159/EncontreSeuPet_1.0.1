<?php

include_once __DIR__ . '/Infra/DbContextoDAO.php';

/**
 * Description of Conexao
 *
 * @author paulo-pc
 */
class Conexao extends DbContextoDAO {
    
    private $con;//conexão

    function __construct() { //configurando
        
        $this->setCon( self::ConexaoMysql()); 
              
    }
        
    public function getCon() {
        return $this->con;
    }

    private function setCon($con) {
        $this->con = $con;
    }
}
