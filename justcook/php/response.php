<?php
    require 'database.php';

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if(isset($_POST)){

        if(isset($_FILES["recipe_image"])){
            $errors = array();
            $file_name = $_FILES["recipe_image"]["name"];
            $file_size = $_FILES["recipe_image"]["size"];
            $file_tmp = $_FILES["recipe_image"]["tmp_name"];
            $file_type = $_FILES["recipe_image"]["type"];
            $file_ext_arr = explode(".", $_FILES["recipe_image"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = array("jpeg", "png", "jpg", "gif");

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not supported";
            }

            if(empty($errors)){
                $img = "recipe-upload-".generateRandomString().".".$file_ext;
                move_uploaded_file($file_tmp, "../img/".$img);

                $database->insert("tb_recipe", [
                    "recipe_name" => $_POST["recipe_name"],
                    "preparation_time" => $_POST["preparation_time"],
                    "cooking_time" => $_POST["cooking_time"],
                    "total_time" => $_POST["total_time"],
                    "portions" => $_POST["portions"],
                    "id_recipe_complex" => $_POST["complex"],
                    "id_recipe_category" => $_POST["recipe_category"],
                    "id_recipe_occasion" => $_POST["recipe_occasion"],
                    "recipe_description" => $_POST["recipe_description"],
                    "recipe_instructions" => $_POST["recipe_instructions"],
                    "recipe_ingredients" => $_POST["recipe_ingredients"],
                    "image_name" => $img,
                    "recipe_status" => 0,
                    "recipe_votes" => 0
                ]);
        

                header("location: adminlist.php");
            }


        }

    }

?>