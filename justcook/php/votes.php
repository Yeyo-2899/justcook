<?php
    require 'database.php';

    if(isset($_GET)){
        
        $data = $database->select("tb_recipe", "*", [
            "id_recipe" => $_GET["id_recipe"]
        ]);

        
        $votes = $data[0]["recipe_votes"];
        $votes++;


        $database->update("tb_recipe",[
            "recipe_votes" => $votes
        ],[
            "id_recipe"=>$_GET["id_recipe"]
        ]);

        
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;

    }
?>