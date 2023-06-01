<?php
include_once 'connectdb.php';


$id = $_POST['id'];
$sql="delete from product where id=$id";
$delete= $pdo->prepare($sql);

if($delete->execute()){

}else{
  
}
