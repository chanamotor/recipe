<?php

function indian_recipe_list(){
  global $connection;
  $query = "select * from recipe where food_category LIKE '%indian%'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die('query failed'.mysqli_error($connection));
  }

  while($row = mysqli_fetch_assoc($result)){
    $recipe=$row['recipe_name'];
    $recipe_id=$row['recipe_id'];
    $recipe_image = $row['recipe_image_id'];
    echo "<option value='$recipe_id'>$recipe</option>";
  }
}
function naga_recipe_list(){
  global $connection;
  $query = "select * from recipe where food_category LIKE '%naga%'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die('query failed'.mysqli_error($connection));
  }

  while($row = mysqli_fetch_assoc($result)){
    $recipe=$row['recipe_name'];
    $recipe_id=$row['recipe_id'];
    $recipe_image = $row['recipe_image_id'];
    echo "<option value='$recipe_id'>$recipe</option>";
  }
}


 ?>
