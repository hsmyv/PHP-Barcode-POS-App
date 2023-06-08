<?php
include_once 'connectdb.php';
session_start();

include_once "header.php";
?>

<style type="text/css">
  .tableFixHead {
    overflow: scroll;
    height: 520px;
  }

  .tableFixHead thead th {
    position: sticky;
    top: 0;
    z-index: 1;
  }

  table {
    border-collapse: collapse;
    width: 100px;
  }

  th,
  td {
    padding: 8px 16px;
  }

  th {
    background: #eee;
  }
</style>

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
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">POS</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Scan Barcode">
                  </div>

                  <label>Minimal</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                  </br>
                  <div class="tableFixHead">
                    <table id="producttable" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <td>Product</td>
                          <td>Stock</td>
                          <td>price</td>
                          <td>QTY</td>
                          <td>Total</td>
                          <td>Delete</td>
                        </tr>
                      </thead>
                      <tbody class="details" id="itemtable">
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td>183</td>
                          <td>John Doe</td>
                          <td>11-7-2014</td>
                          <td>Approved</td>
                          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
                <div class="col-md-4">

                </div>
              </div>


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

<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
