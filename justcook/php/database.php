<?php 
    namespace Medoo;
    require 'Medoo.php';

    if(!isset($database)){
        $database = new Medoo([
            // [required]
            'type' => 'mysql',
            'host' => 'db4free.net:3306',
            'database' => 'recipe',
            'username' => 'kront99',
            'password' => 'Yeyo2899!'
        ]);
    }
?>