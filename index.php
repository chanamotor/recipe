<?php include 'includes/db.php'; ?>
<?php include 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <script src="js/bootstrap.min.js" ></script>
    <script src="js/jquery.min.js" ></script>

    <script type="text/javascript">
      // $(function() {
      //   $("#category_select").change(function() {
      //     if ($("#indian_select").is(":selected")) {
      //       $("#indian_category").show();
      //       $("#naga_category").hide();
      //     } else {
      //       $("#indian_category").hide();
      //       $("#naga_category").show();
      //     }
      //   }).trigger('change');
      // });

            $(document).ready(function() {
              $('#category_select').bind('change', function(e) {
                if ($('#category_select').val() == 'indian') {
                  $("#indian_category").show();
                  $("#naga_category").hide();
                } else if ($('#category_select').val() == 'naga') {
                  $("#indian_category").hide();
                  $("#naga_category").show();
                } else {
                  $("#indian_category").hide();
                  $("#naga_category").hide();
                }
              }).trigger('change');

      });


    </script>

  </head>
  <body>

    <div class="container" >
      <div class="col-xs-6" align="center">
        <h1>Recipe</h1>
        <select id="category_select">
          <option selected="true" disabled="disabled">Choose Recipe</option>
          <option id="indian_select" value="indian">Indian Dish</option>
          <option id="naga_select" value="naga">Naga Dish</option>

        </select>
      </div>
    </div>

    <div class="container" >
      <div class="col-xs-6" align="center" id="indian_category">
        <form class="" action="" method="post">
          <div class="form-group">
            <h1>Indian Recipe</h1>
            <select class="" name="id">
              <option selected="true" disabled="disabled">Choose Recipe</option>
              <?php
                indian_recipe_list();
              ?>
            </select>
          </div>
          <input type="submit" name="submit" value="Submit" class="btn btn-primary">
          <hr>
        </form>
      </div>
    </div>



    <div class="container" >
      <div class="col-xs-6" align="center" id="naga_category">
        <form class="" action="" method="post">
          <div class="form-group">
            <h1>Naga Recipe</h1>
            <select class="" name="id">
              <option selected="true" disabled="disabled">Choose Recipe</option>
              <?php
                naga_recipe_list();
              ?>
            </select>
          </div>
          <input type="submit" name="submit" value="Submit" class="btn btn-primary">
          <hr>
        </form>
      </div>
    </div>




  </body>
</html>

<?php include "display_steps.php"; ?>
