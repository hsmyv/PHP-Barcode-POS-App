<?php

include_once 'connectdb.php';
session_start();

include_once "header.php";

if (isset($_POST['btnsave'])) {
  $category = $_POST["txtcategory"];

  if(empty($category)){
    $_SESSION['status'] = "Category Field is empty";
    $_SESSION['status_code'] = "warning";
  }else{
    $insert  = $pdo->prepare("insert into categories (name) values(:cat)");

    $insert->bindParam(':cat',$category);

    if($insert->execute()){
      $_SESSION['status'] = "Category Added Successfully";
      $_SESSION['status_code'] = "success";
    }else{
      $_SESSION['status'] = "Category Added Failed";
      $_SESSION['status_code'] = "warning";
    }
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
          <h1 class="m-0">Starter Page</h1>
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
      <div class="card card-warning card-outline">
        <div class="card-header">
          <h5 class="m-0">Category Form</h5>
        </div>
        <div class="card-body">



          <div class="row">

            <div class="col-md-4">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                  <input type="text" class="form-control" placeholder="Enter Category" name="txtcategory">
                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-warning" name="btnsave">Submit</button>
                </div>
              </form>
            </div>


            <div class="col-md-8">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <td>#</td>
                    <td>Category</td>
                    <td>Edit</td>
                    <td>Delete</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $select = $pdo->prepare("select * from categories order by id ASC");
                  $select->execute();

                  while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                    echo '
                      <tr>
                      <td>' . $row->id . '</td>
                      <td>' . $row->name . '</td>
                      <td>
                        <button type="submit" class="btn btn-primary" value="' . $row->id . '" name="btnedit">Edit<button>
                      </td>
                      <td>
                        <button name="btndelete" type="submit" value="' . $row->id . '" class="btn btn-info">Delete<button>
                      </td>
                      </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>

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
