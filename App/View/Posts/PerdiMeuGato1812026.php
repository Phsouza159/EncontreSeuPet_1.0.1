<?php
            $id_POST = '4'; 
            if(file_exists('../Site/Layout/MODE_POTS.php'))
            {
                include_once '../Site/Layout/MODE_POTS.php';
            }
            else 
            {
               echo 'Mode nao encontrado';
                exit;
            }
            ?>