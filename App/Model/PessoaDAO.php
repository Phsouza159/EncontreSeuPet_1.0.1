<?php

include_once __DIR__ . '/Infra/CollectionsQuerys.php';
include_once __DIR__ . '/TelefoneDAO.php';
include_once __DIR__ . '/EnderecoDAO.php';
include_once __DIR__ . '/../NucleoClass/Administrador.php';

/**
 * Description of PessoaDAO
 *
 * @author paulo-pc
 */

class PessoaDAO extends CollectionsQuerys {
    /**
     * 
     * @param type $Pessoa
     * @param PDOException $con
     * @return type
     */
    public static function SetNovoUsuario($Pessoa = null,$con = null) {
        print_r($Pessoa);
        $con->beginTransaction();

        $query = "INSERT INTO `PESSOA` (`Nome`,`Sobrenome`,`DtNascimento`,`Sexo`,`Ativo`"
                ." ,`TIPOPESSOA_ID`, `TELEFONE_ID`,`ENDERECO_ID`,`ACESSO_ID`, `POST_ID`, `ANUNCIO_ID`) "
                . "VALUES ('" . $Pessoa->getNome() . "'"
                . ", '".$Pessoa->getSobrenome()."'"
                . ", '".$Pessoa->getDtNascimento()."'"
                . ", '".$Pessoa->getSexo()."'"
                . ", ".$Pessoa->getAtivo()
                . ", '".$Pessoa->getTipoPessoa()."'"
                . ", ".$Pessoa->getTelefone().""
                . ", '".$Pessoa->getEndereco()."'"
                . ", '".$Pessoa->getAcesso()."'"
                . ",  ".$Pessoa->getPOST()
                . ",  ".$Pessoa->getAnuncio().")";
                
        try {

            $con->exec($query);
            self::ValidarCommit($con->commit(), $con);
        } catch (PDOException $con) {
            ErroController::erroFatal("Nao foi possivel salvar a pessoa :: " . $con->getMessage() . "Na sql :: ".$query);
        }
        
        return (self::Get_NEXT_ID_AUTO_INCREMENT_TABLE("Pessoa", $con) -1);
    }
    /**
     * 
     * @param PDOException $con
     * @return type
     */
    public static function getPessoaALL($con = null) {
        parent::VerificarParametros('Default', $con , 'Get into Pessoa');

        $con->beginTransaction();

        $query = "SELECT * , e.ID as ID_ENDERECO , t.ID as ID_TELEFONE FROM pessoa p"
                . " inner join endereco e on p.ENDERECO_ID = e.ID  "
                . "left join telefone t on p.TELEFONE_ID = t.ID where p.Ativo = 1";

        try {
            $dbn = $con->prepare($query);
            $dbn->execute();
            return parent::GetTratarValores('default', $dbn );
            
        } catch (PDOException $con) {
            echo 'falta erro: ' . $con->errorInfo;
        }
    }
    /**
     * 
     * @param type $con
     * @return string
     */
    public static function quantidadePessoa($con){
        try {
            $query = "SELECT COUNT(ativo) FROM pessoa WHERE ativo = 1;";
            
            $dbn = $con->prepare($query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            return $count[0]['COUNT(ativo)'];
            
        } catch (Exception $exc) {
            return "Erro!";
        }
    }
    /**
     * 
     * @param PessoaDTO $Pessoa
     * @param type $Con
     * @return boolean
     */
    public static function  EditarPessoa(PessoaDTO $Pessoa , $Con)
    {
        $Query = "UPDATE pessoa "
                . "  SET Nome           = '".$Pessoa->getNome()."'"
                . ", Sobrenome          = '".$Pessoa->getSobrenome()."'"
                . ", DtNascimento       = '".$Pessoa->getDtNascimento()."'"
                . ", Sexo               = '".$Pessoa->getSexo()."'"
                . ", Ativo              =  ".$Pessoa->getAtivo()
                . ", POST_ID            =  ".$Pessoa->getPOST()
                . ", TIPOPESSOA_ID      =  ".$Pessoa->getTipoPessoa()
                . ", TELEFONE_ID        =  ".$Pessoa->getTelefone()
                . ", ENDERECO_ID        =  ".$Pessoa->getEndereco()
                . ", ACESSO_ID          =  ".$Pessoa->getAcesso()
                . ", ANUNCIO_ID         =  ".$Pessoa->getANUNCIO()
                . " WHERE ID = " . $Pessoa->getId();
        
        try{
            $dbn = $Con->prepare($Query);
            $dbn->execute();
            
            return true;
            
        } catch (Exception $dbn) {
            echo $Query;
            echo $dbn->getMessage();
            
            return false;
        }
    }
    /**
     * 
     * @param type $Id
     * @param type $Con
     * @return type
     */
    public static function getPessoa($Id , $Con)
    {
        $Query = "SELECT * FROM pessoa WHERE id = " . $Id;
     
        try{
            $dbn = $Con->prepare($Query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
            
            return self::tratarValores($count[0] , $Con);
            
        } catch (Exception $dbn) {
            ErroController::erroFatal("Nao foi possivel bucar a pesso :: " . $dbn->getMessage() . " -- " . $Query);
        }
    }
    
    public static function getLogin($login , $passaword , $Con)
    {
        $Query = "SELECT * , a.ID as ID_ACESSO FROM acesso a inner join pessoa p on p.ACESSO_ID = a.ID WHERE a.Usuario = '$login' and a.Senha = '$passaword' ;";
        try {
            
            $dbn = $Con->prepare($Query);
            $dbn->execute();
            $count = self::GetTratarValores('default', $dbn );
             
            $Pessoa = self::tratarValores($count[0] , $Con);
            $Pessoa->setAcesso( new AcessoDTO($count[0]['ID_ACESSO'] , $login , $passaword ));
            return $Pessoa;
            
        } catch (Exception $exc) {
            
            print_r($Pessoa);
            
            return false;
        }
    }
    /**
     * 
     * @param type $Value
     * @param type $Con
     * @return \Patrocinador|\PessoaDTO
     */
    public static function tratarValores($Value , $Con)
    {
       if($Value['TIPOPESSOA_ID'] == 1)
       {
           return new PessoaDTO(
                     $Value['ID']
                    ,$Value['Nome']
                    ,$Value['Sobrenome']
                    ,$Value['Sexo']
                    ,$Value['DtNascimento']
                    ,$Value['Ativo']
                    ,$Value['POST_ID']
                    ,$Value['TIPOPESSOA_ID']
                    , TelefoneDAO::getTelefone($Value['TELEFONE_ID'] , $Con)
                    , EnderecoDAO::getEndereco( $Value['ENDERECO_ID'] , $Con)
                );
       }

       if($Value['TIPOPESSOA_ID'] == 2)
       {
           return new Patrocinador(
                     $Value['ID']
                    ,$Value['Nome']
                    ,$Value['Sobrenome']
                    ,$Value['Sexo']
                    ,$Value['DtNascimento']
                    ,$Value['Ativo']
                    ,$Value['POST_ID']
                    ,$Value['TIPOPESSOA_ID']
                    , TelefoneDAO::getTelefone($Value['TELEFONE_ID'] , $Con)
                    , EnderecoDAO::getEndereco( $Value['ENDERECO_ID'] , $Con)
                );
       }
       if($Value['TIPOPESSOA_ID'] == 3)
       {
            return new Administrador(
                     $Value['ID']
                    ,$Value['Nome']
                    ,$Value['Sobrenome']
                    ,$Value['Sexo']
                    ,$Value['DtNascimento']
                    ,$Value['Ativo']
                    ,$Value['POST_ID']
                    ,$Value['TIPOPESSOA_ID']
                    , TelefoneDAO::getTelefone($Value['TELEFONE_ID'] , $Con)
                    , EnderecoDAO::getEndereco( $Value['ENDERECO_ID'] , $Con)
                ); 
       }
    }
}

