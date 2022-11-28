<?php
    require 'database.php';
    $data = $database->select("tb_recipe","*");
    $categories = $database->select("tb_category","*");
    $occasions = $database->select("tb_occasion","*");
    $complex = $database->select("tb_complex","*");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="../css/styleadminadd.css">

</head>
<body>
    <header>
        <nav class="navbar bg-light fixed-top">
            <div class="container-fluid">
              <a class="navbar-brand logo">JUST COOK</a>
              <button class="navbar-toggler btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><span class="nav-actual">Agregar</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./adminlist.php">Inspeccionar</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="./indexlogin.php">Cerrar</a>
                        </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
    </header>

    <section class="admin-list">
      <div class="form">
        <form action="response.php" method="post" enctype="multipart/form-data" class="add-form">
          <div class="row-1">
            <div class="input-container">
              <label for="recipe_name">Nombre</label>
              <input name="recipe_name" class="input-name" type="text" id="recipename" placeholder="Nombre . . .">
            </div>

            <div class="input-container">
              <label for="preparation_time">T. Preparación</label>
              <select name="preparation_time" class="selector" id="preparationtime">
              <?php
                  $prep_time = ["15 min", "30 min" ,"45 min", "1 hrs", "1 hrs 15 min", "1 hrs 30 min", "1 hrs 45 min", "2 hrs", "2 hrs 15 min", "2 hrs 30 min", "2 hrs 45 min", "3 hrs", "3 hrs 15 min", "3 hrs 30 min", "3 hrs 45 min", "4 hrs", "4 hrs 15 min", "4 hrs 30 min", "4 hrs 45 min", "+5 hrs"];

                  $len = count($prep_time);

                  for($i=0; $i <$len; $i++){
                    echo '<option value="'.$prep_time[$i].'">'.$prep_time[$i].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="input-container">
              <label for="cooking_time">T. Cocción</label>
              <select name="cooking_time" class="selector" id="cookingtime">
              <?php
                  $cook_time = ["15 min", "30 min" ,"45 min", "1 hrs", "1 hrs 15 min", "1 hrs 30 min", "1 hrs 45 min", "2 hrs", "2 hrs 15 min", "2 hrs 30 min", "2 hrs 45 min", "3 hrs", "3 hrs 15 min", "3 hrs 30 min", "3 hrs 45 min", "4 hrs", "4 hrs 15 min", "4 hrs 30 min", "4 hrs 45 min", "+5 hrs"];

                  $len = count($cook_time);

                  for($i=0; $i <$len; $i++){
                    echo '<option value="'.$cook_time[$i].'">'.$cook_time[$i].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="input-container">
              <label for="total_time">T. Total</label>
              <select name="total_time" class="selector" id="totaltime">
              <?php
                  $total_time = ["15 min", "30 min" ,"45 min", "1 hrs", "1 hrs 15 min", "1 hrs 30 min", "1 hrs 45 min", "2 hrs", "2 hrs 15 min", "2 hrs 30 min", "2 hrs 45 min", "3 hrs", "3 hrs 15 min", "3 hrs 30 min", "3 hrs 45 min", "4 hrs", "4 hrs 15 min", "4 hrs 30 min", "4 hrs 45 min", "+5 hrs"];

                  $len = count($total_time);

                  for($i=0; $i <$len; $i++){
                    echo '<option value="'.$total_time[$i].'">'.$total_time[$i].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="input-container">
              <label for="portions">Porciones</label>
              <select name="portions" class="selector" id="portions">
              <?php
                  $portions = ["1", "2" ,"3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "+15"];

                  $len = count($portions);

                  for($i=0; $i <$len; $i++){
                    echo '<option value="'.$portions[$i].'">'.$portions[$i].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="input-container">
              <label for="complex">Complejidad</label>
              <select name="complex" class="selector" id="complex">
              <option>. . .</option>
              <?php
                  $len = count($complex);

                  for($i=0; $i <$len; $i++){
                    echo '<option value="'.$complex[$i]['id_recipe_complex'].'">'.$complex[$i]['complex_name'].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="input-container">
              <label for="recipe_category">Categoría</label>
              <select name="recipe_category" class="selector" id="category">
                <option>. . .</option>
                <?php
                  $len = count($categories);

                  for($i=0; $i <$len; $i++){
                    echo '<option value="'.$categories[$i]['id_recipe_category'].'">'.$categories[$i]['category_name'].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="input-container">
              <label for="recipe_occasion">Ocasión</label>
              <select name="recipe_occasion" class="selector" id="occasion">
                <option>. . .</option>
                <?php
                  $len = count($occasions);

                  for($i=0; $i <$len; $i++){
                    echo '<option value="'.$occasions[$i]['id_recipe_occasion'].'">'.$occasions[$i]['occasion_name'].'</option>';
                  }
                ?>
              </select>
            </div>

          </div>

          <div class="row-1">
            <div class="input-container">
              <label for="recipe_instructions">Instrucciones</label>
              <textarea name="recipe_instructions" class="input-txta" id="intructions" cols="30" rows="10"></textarea>
            </div>

            <div class="input-container">
              <label for="recipe_description">Descripción</label>
              <textarea name="recipe_description" class="input-txta" id="description" cols="30" rows="10"></textarea>
            </div>

            <div class="input-container">
              <label for="recipe_ingredients">Ingredientes</label>
              <textarea name="recipe_ingredients" class="input-txta" id="ingredients" cols="30" rows="10"></textarea>
            </div>

            <div class="input-container">
              <img id="preview" src="../img/preview.png" width="200" height="200" alt="Preview">
              <input id="recipe_image" type="file" name="recipe_image" onchange="readURL(this)">
            </div>

          </div>

          <div class="row-1">
            <div class="form-check">
              <input name="recipe_status" class="form-check-input" type="checkbox" id="outstanding">
              <label class="form-check-label" for="recipe_status">
                Destacado
              </label>
            </div>
            <input class="btn add" type="submit" value="Agregar">
          </div>

        </form>
      </div>
    </section>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>