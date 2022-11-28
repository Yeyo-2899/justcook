<?php
    require './php/database.php';

    $data= $database->select("tb_recipe",[
        "[>]tb_category"=>["id_recipe_category" => "id_recipe_category"],
        "[>]tb_complex"=>["id_recipe_complex" => "id_recipe_complex"],
        "[>]tb_occasion"=>["id_recipe_occasion" => "id_recipe_occasion"]
    ],[
        "tb_recipe.id_recipe",
        "tb_recipe.recipe_name",
        "tb_recipe.total_time",
        "tb_recipe.recipe_votes",
        "tb_recipe.recipe_description",
        "tb_recipe.image_name",             
        "tb_complex.complex_name",
        "tb_occasion.occasion_name",
        "tb_category.category_name"  
    ],[
        "ORDER" => [
            "recipe_votes" => "DESC"
        ],
        'LIMIT' => 10
    ]);

    $categories = $database->select("tb_category","*");
    $occasions = $database->select("tb_occasion","*");
    $complexs = $database->select("tb_complex","*");
    $dest = $database->select("tb_collection","*");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Just Cook</title>

    <!--Link de la librería CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="./css/stylehome.css">

</head>
<body>
    <!--HEADER SECTION-->
    <header class="header">
        <a href="#" class="logo">JUST COOK</a>
        
        <nav class="navbar">
            <a href="./php/recipesbook.php">Recetario</a>
            <a href="#descripcion">Descripción</a>
            <a href="#votes">Más Votado</a>
            <a href="#footer">Info</a>
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
                <h3 class="filter-title">Colecciones</h3>
                <ul class="filter-list">  
                    <?php
                        foreach($dest as $status){
                            echo "<li class='list-element'><a href='recipesbook.php?collection=".$actual["id_collection"]."&name=".$actual["collection_name"]."'>".$actual["collection_name"]."</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>    
    </header>
    
    <!--HOME SECTION-->
    <section class="home" id="home">
    </section>

    <!--DESCRIPCION SECTION-->
    <section class="descripcion" id="descripcion">
        <div class="content">
            <h3>¡Cocina!</h3>
            <p> <span class="highlighter">Just Cook</span> es una página web divertida llena de las recetas más 
                deliciosas para que tú y tu familia se diviertan cocinando. Encuentra recetas que se adapten
                a tus necesidades u ocaciones especiales. ¡Puedes 
                acceder a las recetas ahora mismo! Tambien  
                podrás votar por tus recetas <span class="highlighter">favoritas</span> dentro de nuestro basto
                recetario.<br><br><span class="highlighter">¿Qué esperas?</span> Manos a la obra y 
                comienza a cocinar.</p>
            <a href="./indexrecipesbook.html" class="btn">¡EXPLORA YA!</a>
        </div>
    </section>

    <!--VOTES SECTION-->
    <section class="votes" id="votes">
        <div class="title-box">
            <h2 class="vote-title">Más Votados</h2>
            <a href="./recipesbook.php">Ver Más</a>
        </div>

        <div class="most-voted">
        <?php

            $len = count($data);

            for($i=0; $i<$len; $i++){
                echo "<a class='recipe-target' href='./php/recipe.php?id=".$data[$i]["id_recipe"]."'>";
                echo "<div class='img-recipe'>";
                echo "<img src='./img/".$data[$i]["image_name"]."'>";
                echo "</div>";

                echo "<div class='title-info'>";
                echo "<h3 class='recipe-title'>".$data[$i]["recipe_name"]."</h3>";
                echo "<div class='like fas fa-heart' id='like-btn'>";
                echo "<p class='votes-count'>".$data[$i]["recipe_votes"]."</p>";
                echo "</div>";
                echo "</div>";

                echo "<div class='description-info'>";
                echo "<ul class='description-list'>";
                echo "<li class='list-element'><p class='fas fa-hourglass-end'></p> Tiempo Total : <p class='list-variable'>".$data[$i]["total_time"]."</p></li>";
                echo "<li class='list-element'><p class='fas fa-list'></p> Catergoría: <p class='list-variable'>".$data[$i]["category_name"]."</p></li>"; //Esto requiere conectar con el id de la categoría
                echo "</ul>";
                echo "</div>";

                echo "<div class='description'>";
                echo "<h4 class='description-title'>Descripción</h4>";
                echo "<p>".$data[$i]["recipe_description"]."</p>";
                echo "</div>";

                echo "</a>";
            }
        ?>
        </div>
    </section>

    <!--FOOTER SECTION-->
    <footer id="footer" class="footer">
        <div class="content">
            <a href="#home" class="fas fa-house"></a>
            <p class="info-item">Home</p>
        </div>
        <div class="content">
            <a href="" class="fas fa-share-nodes"></a>
            <p class="info-item">Share</p>
        </div>
        <div class="content">
            <a href="#descripcion" class="fas fa-info"></a>
            <p class="info-item">Info</p>
        </div>
    </footer>
    
    <script src="../js/scripthome.js"></script>
</body>
</html>