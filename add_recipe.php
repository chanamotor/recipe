<?php include 'includes/db.php'; ?>
<?php include 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <script src="js/bootstrap.min.js" ></script>
    <script src="js/jquery.min.js" ></script>
    <link rel="stylesheet" href="includes/styles.css">

    <script>
    $(document).ready(function() {
        var max_fields      = 50;
        var wrapper         = $(".container1");
        var add_button      = $(".add_form_field");

        var x = 1;
        $(add_button).click(function(e){
            e.preventDefault();
            if(x < max_fields){
                x++;
                $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="delete">Delete</a></div>'); //add input box
            }
    		else
    		{
    		alert('You Reached the limits')
    		}
        });

        $(wrapper).on("click",".delete", function(e){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>

  </head>
  <body>
    <div class="">

    </div>
    <div class="container">
      <div class="col-xs-6">
        <h3>Add Recipe</h3>
        <form class="" action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">Category</label>
            <select class="form-control" name="food_category">
              <option value="" selected="true" disabled="disabled">Select Category</option>
              <option value="Indian">Indian Dish</option>
              <option value="Naga">Naga Dish</option>

            </select>
          </div>
          <div class="form-group">
            <label for="">Enter Recipe Name</label>
            <input type="text" class="form-control" name="recipe_name" value="">
          </div>
          <div class="form-group">
            <label for="">Enter Ingredients</label>
            <input type="text" class="form-control" name="ingredient_list" value="">
          </div>
          <div class="form-group">
            <label for="">Image</label>
            <input type="file" class="form-control"  name="image" value="">
          </div>
          <div class="form-group">
            <label for="">Add Tags</label>
            <input type="text" class="form-control" name="tags" value="">
          </div>
          <div class="form-group">
            <label for="">Steps</label>
            <div class="container1">
              <button class="add_form_field">Add New Field &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
              <div><input type="text" name="mytext[]"></div>
            </div>

          </div>
          <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </form>

      </div>
    </div>
  </body>
</html>

<?php
if(isset($_POST['submit'])){
  $post_image = $_FILES['image']['name'];
  $post_image_temp = $_FILES['image']['tmp_name'];
  move_uploaded_file($post_image_temp, "images/$post_image");

  $food_category=$_POST['food_category'];

  $recipe_name = $_POST['recipe_name'];
  $tags = $_POST['tags'];

  $insert_recipe_query = "INSERT into recipe (recipe_name,recipe_image_id,tags,food_category) values ('$recipe_name','$post_image','$tags','$food_category')";
  $insert_recipe_query_result = mysqli_query($connection,$insert_recipe_query);


  $recipe_id_sql = "SELECT recipe_id from recipe where recipe_name='$recipe_name'";
  $recipe_id_result=mysqli_query($connection,$recipe_id_sql);
  $recipe_id_row = mysqli_fetch_row($recipe_id_result);
  $recipe_id = $recipe_id_row[0];

  $input_list = explode(',',$_POST['ingredient_list']);
  foreach ($input_list as $items) {
    //echo $items."<br>";
    $item_search_sql = "SELECT * from ingredients where ingredient_name LIKE '%$items%'";
    $item_search_sql_result = mysqli_query($connection,$item_search_sql);

    $count = mysqli_num_rows($item_search_sql_result);
    if($count==0){
      $insert_ingred_query = "INSERT INTO ingredients (ingredient_name) values('$items')";
      $insert_ingred_query_result = mysqli_query($connection,$insert_ingred_query);

      $ingred_id_query = "SELECT ingredient_id from ingredients where ingredient_name='$items' ";
      $ingred_id_query_result = mysqli_query($connection,$ingred_id_query);
      $ingredient_id_row = mysqli_fetch_row($ingred_id_query_result);
      $ingredient_id = $ingredient_id_row[0];


      $insert_recipe_ingred_query = "INSERT INTO recipe_ingredients (recipe_id,ingredient_id) values('$recipe_id','$ingredient_id') ";
      $insert_recipe_ingred_query_result = mysqli_query($connection,$insert_recipe_ingred_query);
    }
    else{
      $ingred_id_query = "SELECT ingredient_id from ingredients where ingredient_name='$items' ";
      $ingred_id_query_result = mysqli_query($connection,$ingred_id_query);
      $ingredient_id_row = mysqli_fetch_row($ingred_id_query_result);
      $ingredient_id = $ingredient_id_row[0];
      $insert_recipe_ingred_query = "INSERT INTO recipe_ingredients (recipe_id,ingredient_id) values('$recipe_id','$ingredient_id') ";
      $insert_recipe_ingred_query_result = mysqli_query($connection,$insert_recipe_ingred_query);
    }
  }
  $steps_array = $_POST['mytext'];
  foreach($steps_array as $steps){

    $step_query = "INSERT into recipe_steps (recipe_id,instructions) values ('$recipe_id','$steps')";
    $step_query_result = mysqli_query($connection,$step_query);
  }
  echo "<h3>INSERTED</h3>";
}

 ?>
