
#fdsfdsfsf

<?php

$connection = mysqli_connect('localhost','root','','test');
if(!$connection){
  echo "eroor";
}

if(isset($_POST['submit'])){
  //$name = $_POST['name'];
  $input_list = explode(',',$_POST['name']);
  foreach ($input_list as $items) {
    //echo $items."<br>";
    $sql = "select * from table_1 where name LIKE '%$items%'";
    $result = mysqli_query($connection,$sql);

    $count = mysqli_num_rows($result);
    if($count==0){
      $insert_ingred_query = "INSERT INTO table_1 (name) values('$items')";
      $result = mysqli_query($connection,$insert_ingred_query);
      echo "Inserted";
    }
    else{
      continue;
    }


  }
  $input_count = count($input_list);


}

 ?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <form class="" action="" method="post">

      <label for="">Input</label>
      <input type="text" name="name" value="">
      <input type="submit" name="submit" value="Search">

    </form>

  </body>
</html>
