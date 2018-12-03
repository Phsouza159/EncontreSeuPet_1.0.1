<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Anuncios
 *
 * @author FAMILY
 */
class Anuncios {
    
    private static $NomeModeAnuncio = "./Layout/" . "MODE_ANUNCIO.php";
    
    
    public static function GerarAnuncio()
    {
        self::incluirModeAnuncio();
    }
    
    private static function incluirModeAnuncio()
    {
        if(file_exists(self::$NomeModeAnuncio))
        {
            include_once self::$NomeModeAnuncio;
        }
        if(file_exists("MODE_ANUNCIO.php"))
        {
            include_once "MODE_ANUNCIO.php";
        }
        
       
    }
}
