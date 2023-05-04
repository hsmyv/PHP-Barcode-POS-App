<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=php-barcode', 'root', '');

} catch (\Exception $e) {
  echo $e->getMessage();
}


?>
