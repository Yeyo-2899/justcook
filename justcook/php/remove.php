<?php 
    require 'database.php';

    $database->delete("tb_recipe",[
        "id_recipe"=>$_POST["id_recipe"]
    ]);

    header("location: adminlist.php");
?>