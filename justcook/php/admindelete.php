<?php
   
    require 'database.php';

    if(isset($_GET)){
        $data = $database->select("tb_recipe", "*", [
            "id_recipe" => $_GET["id"]
        ]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>

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
        <div class="add-form">
          <div class="row-1">
            <h1>¿Deseas eliminar la receta?</h1>
          </div>

          <form action="remove.php" method="post" class="row-1">
            <input type="submit" value="SÍ" class="btn">
            <input type="hidden" name="id_recipe" value="<?php echo $data[0]["id_recipe"]; ?>">
            <input type="button" value="CANCELAR" class="btn" onclick="history.back();">
          </form>

        </div>
      </div>
    </section>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>