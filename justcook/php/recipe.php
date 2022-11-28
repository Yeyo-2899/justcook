<?php
    require 'database.php';

    $categories = $database->select("tb_category","*");
    $occasions = $database->select("tb_occasion","*");
    $complexs = $database->select("tb_complex","*");

    if(isset($_GET)){
        $data = $database->select("tb_recipe","*",[
            "id_recipe" => $_GET["id"],
        ]);
    }

    $relateds = $database->select("tb_recipe","*",[
        "id_recipe_category" => $data[0]["id_recipe_category"],
        "id_recipe_category" => $data[0]["id_recipe_category"],
        'LIMIT' => 4
    ]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta</title>

    <!--Link de la librería CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/stylerecipe.css">


</head>
<body>
    <!--HEADER SECTION-->
    <header class="header">
        <a href="../index.php" class="logo">JUST COOK</a>
        
        <nav class="navbar">
            <a href="../index.php">Home</a>
            <a href="./recipesbook.php">Recetario</a>
            <a href="#related">Relacionadas</a>
        </nav>

        <div class="icons">
            <div id="search-space" class="fas fa-search"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <form class="search-form" action="search.php" method="get" role="search">
            <input type="search" id="search-box" placeholder="Search..." name="keyword" aria-label="Search">
            <label id="filter-btn" class="fas fa-filter search-buttons"></label>
            <button id="search-btn" for="search-box" class="fas fa-search search-buttons" type="submit"></button>
        </form>

        <div class="filters-container">
            <div class="filters">
                <h3 class="filter-title">Complejidad</h3>
                <ul class="filter-list">
                    <?php
                        foreach($complexs as $complex){
                            echo "<li class='list-element'><a href='recipesbook.php?complex=".$complex["id_recipe_complex"]."&name=".$complex["complex_name"]."'>".$complex["complex_name"]."</a></li>";
                        }
                    ?>
                </ul>
                <h3 class="filter-title">Catergorías</h3>
                <ul class="filter-list">
                    <?php
                        foreach($categories as $category){
                            echo "<li class='list-element'><a href='recipesbook.php?category=".$category["id_recipe_category"]."&name=".$category["category_name"]."'>".$category["category_name"]."</a></li>";
                        }
                    ?>
                </ul>
                <h3 class="filter-title">Ocaciones</h3>
                <ul class="filter-list">
                    <?php
                        foreach($occasions as $occasion){
                            echo "<li class='list-element'><a href='recipesbook.php?occasion=".$occasion["id_recipe_occasion"]."&name=".$occasion["occasion_name"]."'>".$occasion["occasion_name"]."</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>    
    </header>

    <!--RECIPE SECTION-->
    <section class="recipe" id="recipe">
        <div class="recipe-container">
            <div class="img-recipe">
                <img src="../img/<?php echo $data[0]["image_name"]?>" alt="">
            </div>

            <div class="info-box">
                <div class="info-title">
                    <h1 class="recipe-title"><?php echo $data[0]["recipe_name"];?></h1>
                    <a href="./votes.php?id_recipe=<?php echo $data[0]["id_recipe"]?>" class="like fas fa-heart" id="like-btn">
                        <p class="votes-count"><?php echo $data[0]["recipe_votes"];?></p>
                    </a>
                </div>

                <div class="info-container">
                    <div class="list-info">
                        <ul class="list">
                            <li class="list-element"><p class="fas fa-hourglass-start"></p> Tiempo Preparación: <p class="list-variable"><?php echo $data[0]["preparation_time"];?></p></li>
                            <li class="list-element"><p class="fas fa-hourglass-half"></p> Tiempo Cocción: <p class="list-variable"><?php echo $data[0]["cooking_time"];?></p></li>
                            <li class="list-element"><p class="fas fa-hourglass-end"></p> Tiempo Total: <p class="list-variable"><?php echo $data[0]["total_time"];?></p></li>
                        </ul>
                    </div>

                    <div class="list-info">
                        <ul class="list">
                            <li class="list-element"><p class="fas fa-utensils"></p> Porciones: <p class="list-variable"><?php echo $data[0]["portions"];?></p></li>
                            <li class="list-element"><p class="fas fa-scale-unbalanced-flip"></p> Complejidad: <p class="list-variable">
                                    <?php 
                                        $len = count($complexs);

                                        for($i=0;$i<$len;$i++){
                                            if($data[0]["id_recipe_complex"] == $complexs[$i]["id_recipe_complex"]){
                                                echo $complexs[$i]["complex_name"];
                                            }
                                        }
                                    ?>
                                </p>
                            </li>
                            <li class="list-element"><p class="far fa-calendar-days"></p> Ocación: <p class="list-variable">
                                    <?php 
                                    $len = count($occasions);

                                    for($i=0;$i<$len;$i++){
                                        if($data[0]["id_recipe_occasion"] == $occasions[$i]["id_recipe_occasion"]){
                                            echo $occasions[$i]["occasion_name"];
                                        }
                                    }
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="list-info">
                        <ul class="list">
                            <li class="list-element"><p class="fas fa-list"></p> Catergoría: <p class="list-variable">
                                    <?php 
                                    $len = count($categories);

                                    for($i=0;$i<$len;$i++){
                                        if($data[0]["id_recipe_category"] == $categories[$i]["id_recipe_category"]){
                                            echo $categories[$i]["category_name"];
                                        }
                                    }
                                    ?>
                                </p>
                            </li> <!--Aquí se debe conectar con la tabla de categoria-->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="description-container">
                <h2 class="description-title">Descripción</h2>
                <p class="description"><?php echo $data[0]["recipe_description"];?></p>
            </div>

            <!--ESTO ESTÁ PENDIENTE, HAY QUE VER COMO GUARDAR Y SEPARAR LAS INSTRUCCIONES-->
            <div class="instructions-box">
                <div class="instructions-container">
                    <h2 class="instructions-title">Instrucciones</h2>
                    <div class="instructions">
                        <ul>
                            <li><?php echo $data[0]["recipe_instructions"]?></li>
                        </ul>
                    </div>
                </div>

                <!--ESTO ESTÁ PENDIENTE, HAY QUE VER COMO GUARDAR Y SEPARAR LOS INGREDIENTES-->
                <div class="instructions-container">
                    <h2 class="instructions-title">Ingredientes</h2>
                    <div class="instructions">
                        <ul>
                        <li><?php echo $data[0]["recipe_ingredients"]?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <h2 class="related-title">Relacionadas</h2>
            <div class="related" id="related">

                <?php

                foreach($relateds as $data){
                    echo "<a class='recipe-target' href='./recipe.php?id=".$data["id_recipe"]."'>";
                    echo "<div class='img-target'>";
                    echo "<img src='../img/".$data["image_name"]."'>";
                    echo "</div>";

                    echo "<div class='title-info-target'>";
                    echo "<h3 class='recipe-title-target'>".$data["recipe_name"]."</h3>";
                    echo "<div class='like fas fa-heart' id='like-btn'>";
                    echo "<p class='votes-count'>".$data["recipe_votes"]."</p>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='description-info'>";
                    echo "<ul class='description-list'>";
                    echo "<li class='list-element'><p class='fas fa-hourglass-end'></p> Tiempo Total : <p class='list-variable'>".$data["total_time"]."</p></li>";
                    echo "<li class='list-element'><p class='fas fa-list'></p> Catergoría: <p class='list-variable'>".$data["id_recipe_category"]."</p></li>";
                    echo "</ul>";
                    echo "</div>";

                    echo "<div class='description-target'>";
                    echo "<h4 class='description-title-target'>Descripción</h4>";
                    echo "<p>".$data["recipe_description"]."</p>";
                    echo "</div>";

                    echo "</a>";
                }

                ?>

            </div>

            

        </div>
    </section>

    <script src="../js/scriptrecipe.js"></script>
</body>
</html>