<?php
include_once 'connectdb.php';
session_start();

include_once "header.php";

$id = $_GET['id'];
$select = $pdo->prepare("SELECT * from product where id=$id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$id = $row['id'];

$barcode_db = $row['barcode'];
$product_db = $row['product'];
$category_db = $row['category'];
$description_db = $row['description'];
$stock_db = $row['stock'];
$purchaseprice_db = $row['purchaseprice'];
$saleprice = $row['saleprice'];
$image_db = $row['image'];

if (isset($_POST['btneditproduct'])) {
  // $barcode_txt = $_POST['txtbarcode'];
  $product_txt = $_POST['txtname'];
  $category_txt = $_POST['txtselect_option'];
  $description_txt = $_POST['txtdescription'];
  $stock_txt = $_POST['txtstock'];
  $purchaseprice_txt = $_POST['txtpurchaseprice'];
  $saleprice_txt = $_POST['txtsaleprice'];

  $f_name = $_FILES['myfile']['name'];
  if (!empty($f_name)) {
    $f_tmp = $_FILES['myfile']['tmp_name'];
    $f_size = $_FILES['myfile']['size'];
    $f_extension = explode('.', $f_name);
    $f_extension = strtolower(end($f_extension));

    $f_newfile = uniqid() . '.'   . $f_extension;
    $store = "productimages/" . $f_newfile;

    if ($f_extension == "jpg" || $f_extension == "jpeg" || $f_extension == "png" || $f_extension == "gif") {
      if ($f_size >= 100000) {
        $_SESSION['status'] = "Max file should be 1MB";
        $_SESSION['status_code'] = "warning";
      } else {
        if (move_uploaded_file($f_tmp, $store)) {
          $f_newfile;
          $update = $pdo->prepare("UPDATE product set product=:product, category=:category, description=:description, stock=:stock, purchaseprice=:pprice, saleprice=:sprice, image=:image WHERE id=$id");
          $update->bindParam(':product', $product_txt);
          $update->bindParam(':category', $category_txt);
          $update->bindParam(':description', $description_txt);
          $update->bindParam(':stock', $stock_txt);
          $update->bindParam(':pprice', $purchaseprice_txt);
          $update->bindParam(':sprice', $saleprice_txt);
          $update->bindParam(':image', $f_newfile);
        }
        if ($update->execute()) {
          $_SESSION['status'] = "Product updated successfully";
          $_SESSION['status_code'] = "success";
        } else {
          $_SESSION['status'] = "Product not updated!";
          $_SESSION['status_code'] = "warning";
        }
      }
    }
  } else {
    $update = $pdo->prepare("UPDATE product set product=:product, category=:category, description=:description, stock=:stock, purchaseprice=:pprice, saleprice=:sprice, image=:image WHERE id=$id");
    $update->bindParam(':product', $product_txt);
    $update->bindParam(':category', $category_txt);
    $update->bindParam(':description', $description_txt);
    $update->bindParam(':stock', $stock_txt);
    $update->bindParam(':pprice', $purchaseprice_txt);
    $update->bindParam(':sprice', $saleprice_txt);
    $update->bindParam(':image', $image_db);
  }
  if ($update->execute()) {
    $_SESSION['status'] = "Product updated successfully";
    $_SESSION['status_code'] = "success";
  } else {
    $_SESSION['status'] = "Product not updated!";
    $_SESSION['status_code'] = "warning";
  }
}


$select = $pdo->prepare("SELECT * from product where id=$id");
$select->execute();

$row = $select->fetch(PDO::FETCH_ASSOC);

$id = $row['id'];

$barcode_db = $row['barcode'];
$product_db = $row['product'];
$category_db = $row['category'];
$description_db = $row['description'];
$stock_db = $row['stock'];
$purchaseprice_db = $row['purchaseprice'];
$saleprice = $row['saleprice'];
$image_db = $row['image'];

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0" Add Product></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">




        <!-- /.col-md-6 -->
        <div class="col-lg-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">Edit Product</h5>
            </div>
            <form action="" method="POST" name="formeditproduct" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Barcode</label>
                      <input value="<?php echo $barcode_db; ?>" type="text" class="form-control" placeholder="Enter name" name="txtbarcode" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input value="<?php echo $product_db; ?>" type="text" class="form-control" placeholder="Enter name" name="txtname" required>
                    </div>

                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" name="txtselect_option" required>
                        <option value="" disabled selected>Select Category</option>
                        <?php
                        $select = $pdo->prepare("select * from categories order by id desc");
                        $select->execute();

                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                          extract($row);
                        ?>
                          <option <?php if ($row['name'] == $category_db) { ?> selected="selected" <?php } ?>> <?php echo $row['name']; ?></option>
                        <?php  } ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea type="text" class="form-control" placeholder="Enter description" name="txtdescription" rows="4" required><?php echo $description_db; ?></textarea>
                    </div>

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stock Quantity</label>
                      <input value="<?php echo $stock_db; ?>" type="number" min="1" step="any" class="form-control" placeholder="Enter name" name="txtstock" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Purchase Price</label>
                      <input value="<?php echo $purchaseprice_db; ?>" type="number" min="1" step="any" class="form-control" placeholder="Enter name" name="txtpurchaseprice" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sale Price</label>
                      <input value="<?php echo $saleprice; ?>" type="number" min="1" step="any" class="form-control" placeholder="Enter name" name="txtsaleprice" required>
                    </div>
                    <div class="form-group">
                      <label>Product Image</label>
                      <img src="productimages/<?php echo $image_db ?>" class="img-rounded" width="150px" height="150px" /></img>
                      <input type="file" class="input-group" placeholder="Enter name" name="myfile">
                      <p>Upload image</p>
                    </div>

                  </div>

                </div>
              </div>
              <div class="card-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btneditproduct">Update Product</button>
                </div>
              </div>
            </form>

          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once "footer.php";
?>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
}
?>
<script>
  Swal.fire({
    icon: '<?php echo $_SESSION['status_code']; ?>',
    title: '<?php echo $_SESSION['status']; ?>'
  });
</script>

<?php
unset($_SESSION['status']);
?>
