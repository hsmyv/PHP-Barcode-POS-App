<?php

include_once "ui/connectdb.php";

session_start();

if (isset($_POST['btn_login'])) {
  $useremail = $_POST['txt_email'];
  $password = $_POST['txt_password'];

  $select = $pdo->prepare("SELECT * from users where email='$useremail' AND password='$password'");
  $select->execute();

  $row = $select->fetch(PDO::FETCH_ASSOC);

  if (is_array($row)) {


    if ($row['email'] == $useremail and $row['password'] == $password and $row['role'] == "Admin") {
      $_SESSION['status'] = "Login success by Admin";
      $_SESSION['status_code'] = "success";

      header('refresh: 1; ui/dashboard.php');


      $_SESSION['userid'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['role'] = $row['role'];
    } else if ($row['email'] == $useremail and $row['password'] and $row['role'] == "User") {

      $_SESSION['status'] = "Login success by User";
      $_SESSION['status_code'] = "success";

      header('refresh: 1; ui/user.php');

      $_SESSION['userid'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['role'] = $row['role'];
    }
  } else {
    $_SESSION['status'] = "Incorrect email or password";
    $_SESSION['status_code'] = "error";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POS BARCODE | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>POS</b>BARCODE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">

            <input type="email" class="form-control" placeholder="Email" name="txt_email" required>

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">

            <input type="password" class="form-control" placeholder="Password" name="txt_password" required>

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <a href="forgot-password.html">I forgot my password</a>

              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="btn_login">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
        </p>
        <p class="mb-0">
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="../../plugins/toastr/toastr.min.js"></script>
</body>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
}
?>
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: '<?php echo $_SESSION['status_code']; ?>',
      title: '<?php echo $_SESSION['status']; ?>'
    })
  });
</script>
<?php
unset($_SESSION['status']);
?>

</html>
