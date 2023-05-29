<?php
if(isset($_POST['submit'])){
  $f_name = $_FILES['myfile']['name'];
  $f_tmp = $_FILES['myfile']['tmp_name'];
  $f_size = $_FILES['myfile']['size'];
  $f_extension = explode('.',$f_name);
  $f_extension = strtolower(end($f_extension));

  echo $f_newfile = uniqid().'.'.$f_extension;
  $store = "upload/" . $f_newfile;

  if($f_extension == "jpg" || $f_extension == "png" || $f_extension == "gif"){
    if($f_size >= 100000){
      echo 'Max file should be 1MB';
    }
  }else{
    if(move_uploaded_file($f_tmp, $store)){
      echo 'uploaded';
    }
  }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
    <p><input type="file" name="myfile"></p>
    <p><input type="submit" value="upload" name="submit"></p>
  </form>
</body>
</html>
