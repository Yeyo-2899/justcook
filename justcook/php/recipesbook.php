<?php
    require 'database.php';

    if($_GET){
         
        $column ="";
        $value = 0;

        if(isset($_GET["complex"])){
            $column = "tb_recipe.id_recipe_complex";
            $value = $_GET["complex"];
        }else if(isset($_GET["category"])){
            $column = "tb_recipe.id_recipe_category";
            $value = $_GET["category"];
        }else if(isset($_GET["occasion"])){
            $column = "tb_recipe.id_recipe_occasion";
            $value = $_GET["occasion"];
        }

        $results= $database->select("tb_recipe",[
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
            $column => $value
        ]);

    }else{

        $results= $database->select("tb_recipe",[
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
        ]);
    }

    $categories = $database->select("tb_category","*");
    $occasions = $database->select("tb_occasion","*");
    $complexs = $database->select("tb_complex","*");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetario</title>

    <!--Link de la librería CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/stylerecipesbook.css">

</head>
<body>
    <!--HEADER SECTION-->
    <header class="header">
        <a href="../index.php" class="logo">JUST COOK</a>
        
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

        <div class="icons">
            <div id="home-btn" class="fas fa-home"></div>
        </div>

    </header>

    <!--RECIPES SECTION-->
    <section class="recipes" id="recipes">
        <div class="recipes-container">

            <?php
    
            foreach($results as $recipe){
                echo "<a class='recipe-target' href='./recipe.php?id=".$recipe["id_recipe"]."'>";
                echo "<div class='img-recipe'>";
                echo "<img src='../img/".$recipe["image_name"]."'>";
                echo "</div>";

                echo "<div class='title-info'>";
                echo "<h3 class='recipe-title'>".$recipe["recipe_name"]."</h3>";
                echo "<div class='like fas fa-heart' id='like-btn'>";
                echo "<p class='votes-count'>".$recipe["recipe_votes"]."</p>";
                echo "</div>";
                echo "</div>";

                echo "<div class='description-info'>";
                echo "<ul class='description-list'>";
                echo "<li class='list-element'><p class='fas fa-hourglass-end'></p> Tiempo Total : <p class='list-variable'>".$recipe["total_time"]."</p></li>";
                echo "<li class='list-element'><p class='fas fa-list'></p> Catergoría: <p class='list-variable'>".$recipe["category_name"]."</p></li>"; //Esto requiere conectar con el id de la categoría
                echo "</ul>";
                echo "</div>";

                echo "<div class='description'>";
                echo "<h4 class='description-title'>Descripción</h4>";
                echo "<p>".$recipe["recipe_description"]."</p>";
                echo "</div>";

                echo "</a>";
            }
            ?>
            
        </div>

        
    </section>


    <script src="../js/scriptrecipesbook.js"></script>
</body>
</html>