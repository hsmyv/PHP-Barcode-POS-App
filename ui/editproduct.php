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
                      <input value="<?php echo $barcode_db; ?>" type="text" class="form-control" placeholder="Enter name" name="txtbarcode">
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
                      <img src="productimages/<?php $image_db ?>" class="img-responsive"></img>
                      <input type="file" class="input-group" placeholder="Enter name" name="myfile" required>
                      <p>Upload image</p>
                    </div>

                  </div>

                </div>
              </div>
              <div class="card-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btneditproduct">Edit Product</button>
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
