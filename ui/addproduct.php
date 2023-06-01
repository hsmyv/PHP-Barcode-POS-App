<?php

include_once 'connectdb.php';
session_start();

include_once "header.php";

if (isset($_POST['btnsave'])) {
  $barcode = $_POST['txtbarcode'];
  $product = $_POST['txtname'];
  $category = $_POST['txtselect_option'];
  $description = $_POST['txtdescription'];
  $stock = $_POST['txtstock'];
  $purchaseprice = $_POST['txtpurchaseprice'];
  $saleprice = $_POST['txtsaleprice'];

  $f_name = $_FILES['myfile']['name'];
  $f_tmp = $_FILES['myfile']['tmp_name'];
  $f_size = $_FILES['myfile']['size'];
  $f_extension = explode('.', $f_name);
  $f_extension = strtolower(end($f_extension));

  echo $f_newfile = uniqid() . '.' . $f_extension;
  $store = "productimages/" . $f_newfile;

  if ($f_extension == "jpg" || $f_extension == "jpeg" || $f_extension == "png" || $f_extension == "gif") {
    if ($f_size >= 100000) {
      $_SESSION['status'] = "Max file should be 1MB";
      $_SESSION['status_code'] = "warning";
    } else {
      if (move_uploaded_file($f_tmp, $store)) {
        $productimage = $f_newfile;

        if (empty($barcode)) {
          $insert = $pdo->prepare("INSERT INTO product (product, category, description, stock, purchaseprice, saleprice, image)
          VALUES (:product, :category, :description, :stock, :pprice, :saleprice, :img)");

          // $insert->bindParam(':barcode', $barcode);
          $insert->bindParam(':product', $product);
          $insert->bindParam(':category', $category);
          $insert->bindParam(':description', $description);
          $insert->bindParam(':stock', $stock);
          $insert->bindParam(':pprice', $purchaseprice); // corrected variable name
          $insert->bindParam(':saleprice', $saleprice);
          $insert->bindParam(':img', $productimage);

          $insert->execute();

          $id = $pdo->lastInsertId();
          date_default_timezone_set("Asia/Calcutta");
          $newbarcode = $id . date('his');
          $update = $pdo->prepare("UPDATE product SET barcode='$newbarcode' WHERE id='" . $id . "'");

          if ($update->execute()) {
            $_SESSION['status'] = "Product inserted successfully";
            $_SESSION['status_code'] = "success";
          } else {
            $_SESSION['status'] = "Product not inserted Failed";
            $_SESSION['status_code'] = "warning";
          }
        } else {
          $insert = $pdo->prepare("INSERT INTO product (barcode, product, category, description, stock, purchaseprice, saleprice, image)
          VALUES (:barcode, :product, :category, :description, :stock, :pprice, :saleprice, :img)");

          $insert->bindParam(':barcode', $barcode);
          $insert->bindParam(':product', $product);
          $insert->bindParam(':category', $category);
          $insert->bindParam(':description', $description);
          $insert->bindParam(':stock', $stock);
          $insert->bindParam(':pprice', $purchaseprice); // corrected variable name
          $insert->bindParam(':saleprice', $saleprice);
          $insert->bindParam(':img', $productimage);




          if ($insert->execute()) {
            $_SESSION['status'] = "Product inserted successfully";
            $_SESSION['status_code'] = "success";
          } else {
            $_SESSION['status'] = "Product not inserted Failed";
            $_SESSION['status_code'] = "warning";
          }
        }
      }
    }
  } else {
    $_SESSION['status'] = "Only jpg, jpeg, and gif can be upload file";
    $_SESSION['status_code'] = "warning";
  }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li> -->
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
              <h5 class="m-0">Product</h5>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Barcode</label>
                      <input type="text" class="form-control" placeholder="Enter name" name="txtbarcode">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" class="form-control" placeholder="Enter name" name="txtname" required>
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
                          <option value=""><?php echo $row['name'] ?></option>
                        <?php  } ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea type="text" class="form-control" placeholder="Enter description" name="txtdescription" rows="4" required></textarea>
                    </div>

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Stock Quantity</label>
                      <input type="number" min="1" step="any" class="form-control" placeholder="Enter name" name="txtstock" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Purchase Price</label>
                      <input type="number" min="1" step="any" class="form-control" placeholder="Enter name" name="txtpurchaseprice" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sale Price</label>
                      <input type="number" min="1" step="any" class="form-control" placeholder="Enter name" name="txtsaleprice" required>
                    </div>
                    <div class="form-group">
                      <label>Product Image</label>
                      <input type="file" class="input-group" placeholder="Enter name" name="myfile" required>
                      <p>Upload image</p>
                    </div>

                  </div>

                </div>
              </div>
              <div class="card-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-warning" name="btnsave">Save</button>
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
