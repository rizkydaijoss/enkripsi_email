<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="./assets/plugins/sweetalert/js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/plugins/sweetalert/css/sweetalert.css">
  </head>
  <body>
  </body>
</html>
<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if(isset($_POST['login']))
{
    $usermail=$_POST['email'];
    $password=$_POST['pswd'];
    if(strpos($usermail, "@yahoo")==true || strpos($usermail, "@ymail")==true){
    	$hostname = '{imap.mail.yahoo.com:993/imap/ssl}';
    }elseif(strpos($usermail, "@gmail")==true){
    	$hostname = '{imap.gmail.com:993/imap/ssl}';
    }else{
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Login gagal',
          text: 'Hanya akun email Google yang diperbolehkan',
          imageUrl: 'assets/images/logo/error.png',
      }, function() {
          window.location = 'login.php';
      });
      });
      </script>";
    }

    //validasi
	  if($usermail==''){
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Login gagal',
          text: 'Masukkan Email!',
          imageUrl: 'assets/images/logo/error.png',
      }, function() {
          window.location = 'login.php';
      });
      });
      </script>";
		exit();
		}else if($password==''){
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Login gagal',
          text: 'Masukkan Password!',
          imageUrl: 'assets/images/logo/error.png',
      }, function() {
          window.location = 'login.php';
      });
      });
      </script>";
		exit();
		}

    if(imap_open($hostname,$usermail,$password)){
    	ini_set('max_execution_time', -1);
      ini_set('memory_limit', -1);
      $_SESSION['email']= $usermail;//here session is used and value of $user_email store in $_SESSION.
		  $_SESSION['pswd']= $password;
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Login berhasil',
          text: '',
          imageUrl: 'assets/images/logo/sukses.png',
          timer: 3000,
          showConfirmButton: false
      }, function() {
          window.location = 'dashboard.php';
      });
      });
      </script>";
  }else
		{
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Login gagal',
          text: 'Pastikan Email dan Password Benar!',
          imageUrl: 'assets/images/logo/error.png',
      }, function() {
          window.location = 'login.php';
      });
      });
      </script>";
    }
  }
	else
		{
      echo "<script>
      setTimeout(function() {
      swal({
          title: 'Login gagal',
          text: 'Form tidak diset dengan baik.',
          imageUrl: 'assets/images/logo/error.png',
      }, function() {
          window.location = 'login.php';
      });
      });
      </script>";
    }
?>
