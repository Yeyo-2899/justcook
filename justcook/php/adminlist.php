<?php
    require 'database.php';

    $data= $database->select("tb_recipe",[
        "[>]tb_category"=>["id_recipe_category" => "id_recipe_category"],
        "[>]tb_complex"=>["id_recipe_complex" => "id_recipe_complex"],
        "[>]tb_occasion"=>["id_recipe_occasion" => "id_recipe_occasion"]
    ],[
        "tb_recipe.id_recipe",
        "tb_recipe.recipe_name",
        "tb_recipe.image_name",             
        "tb_complex.complex_name",
        "tb_occasion.occasion_name",
        "tb_category.category_name"  
    ], ["ORDER"=>["tb_recipe.id_recipe" => "ASC"]]); //ORDENAMOS DE FORMA ASCENDENTE
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="../css/styleadminlist.css">

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
                            <a class="nav-link active" aria-current="page" href="./adminadd.html">Agregar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><span class="nav-actual">Inspeccionar</span></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="./indexlogin.html">Cerrar</a>
                        </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
    </header>

    <section class="admin-list">
      <a class="add btn" href="./adminadd.php">Agregar</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Complejidad</th>
            <th scope="col">Categoría</th>
            <th scope="col">Ocación</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php

            $len = count($data);
    
            for($i=0; $i<$len; $i++){
                echo "<tr>";
                echo "<th scope='row'>".$data[$i]["id_recipe"]."</th>";
                echo "<td>".$data[$i]["recipe_name"]."</td>";
                echo "<td>".$data[$i]["complex_name"]."</td>"; 
                echo "<td>".$data[$i]["category_name"]."</td>";
                echo "<td>".$data[$i]["occasion_name"]."</td>";
                echo "<td><a href='adminedit.php?id=".$data[$i]["id_recipe"]."'>Editar</a> <a href='admindelete.php?id=".$data[$i]["id_recipe"]."'>Eliminar</a></td>";
                echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </section>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>