<?php

if(isset($_POST['submit'])){
  $id = $_POST['id'];
  $sql = "select * from recipe_steps where recipe_id=$id order by step_no";
  $result = mysqli_query($connection,$sql);
  if(!$result){
    die('query failed'.mysqli_error($connection));
  }
  $step_no = mysqli_num_rows($result);
  $i=1;

  $ingredient_query = "select ingredient_name from ingredients i  INNER JOIN recipe_ingredients ri  ON ri.ingredient_id = i.ingredient_id where ri.recipe_id=$id";
  $ing_result = mysqli_query($connection,$ingredient_query);
  if(!$ing_result){
    die("error".mysqli_error($connection));
  }

  $recipe_all_query = "select * from recipe where recipe_id=$id";
  $recipe_all_query_result = mysqli_query($connection,$recipe_all_query);
  if(!$recipe_all_query_result){
    die('query failed'.mysqli_error($connection));
  }

  while($row = mysqli_fetch_assoc($recipe_all_query_result)){
    $recipe=$row['recipe_name'];
    $recipe_id=$row['recipe_id'];
    $recipe_image = $row['recipe_image_id'];

  }

 ?>
   <div class="container">

     <div class="row">
       <div class="col-md-12">
         <h2><?php echo $recipe; ?></h2>

       </div>

     </div>
     <div class="row">
         <div class="col-md-4">
                 <div class="col-md-12 ">
                   <img src="images/<?php echo $recipe_image; ?>" class="img-thumbnail" alt="">
                 </div>
                 <div class="col-md-12 ">
                   <p class="bg-danger"><b><u>Ingredients Needed:</u></b><br>
                     <?php
                     while($row = mysqli_fetch_assoc($ing_result)){
                       $ing_name = $row['ingredient_name'];
                       echo $ing_name.',';
                     }
                      ?>
                   </p>
                 </div>
         </div>
         <div class="col-md-8 ">
           <p class="bg-warning"><b><u>Instructions:</u></b><br>
             <?php
             while($row = mysqli_fetch_assoc($result)){
               $stepss = $step_no-($step_no-$i);
               $steps = $row['instructions'];
               echo "<b><u>Step $stepss:</u></b><br>";
               echo $steps."<br><br>";
                ++$i;
             }
              ?>
           </p>
         </div>
     </div>

   </div>
<?php } ?>
