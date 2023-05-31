<?php
include_once 'connectdb.php';
session_start();

include_once "header.php";

include 'barcode/barcode128.php';

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0" View Product></h1>
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
          <div class="card card-info card-outline">
            <div class="card-header">
              <h5 class="m-0">View Product</h5>
            </div>
            <div class="card-body">

            <?php
            $id = $_GET['id'];
            $select = $pdo->prepare("SELECT * from product where id = $id");
            $select->execute();

            while($row = $select->fetch(PDO::FETCH_OBJ)) {
              echo '<div class="row">
                <div class="col-md-6">
                  <ul class="list-group">
                    <center><p class="list-group-item list-group-item-info"><b>Product Details</b></p></center>
                    <li class="list-group-item">Barcode<span class="badge badge-light float-right">' . bar128($row->barcode) . '</span></li>
                   <li class="list-group-item">Product Name<span class="badge badge-warning float-right">'.$row->product. '</li>
                    <li class="list-group-item">Category<span class="badge badge-success float-right">' . $row->category . '</li>
                    <li class="list-group-item">Description<span class="badge badge-primary float-right">' . $row->description . '</li>
                    <li class="list-group-item">Stock<span class="badge badge-danger float-right">' . $row->stock . '</li>
                    <li class="list-group-item">Purchase Price<span class="badge badge-secondary float-right">' . $row->purchaseprice . '</li>
                    <li class="list-group-item">Sale Price<span class="badge badge-dark float-right">' . $row->saleprice . '</li>
                    <li class="list-group-item">Product Profit<span class="badge badge-success float-right">' . $row->saleprice - $row->purchaseprice . '</li>
                    </ul>
                </div>
                <div class="col-md-6">
                  <ul class="list-group">
                    <center><p class="list-group-item list-group-item-info"><b>Product Image </b></p></center>
                    <img src="productimages/'.$row->image.'" class="img-responsive"></img>
                  </ul>
                </div>
              </div>';
            }
            ?>

            </div>
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
