
<?php  

// Lampirkan dbconfig 
require_once "config-db.php"; 
// Cek status login user 
if(!$user->isLoggedIn()){ 
  header("location: index.php"); //Redirect ke halaman login 
} 
// Ambil data user saat ini 
$currentUser = $user->getUser(); 

if (isset($_POST['btn-save'])) {

    $nama = $_POST['nama']; 
    $email = $_POST['email']; 
    $password = $_POST['password'];

 if ($kelolauser->insertData($nama, $email, $password)) {
     header("Location: adduser.php?inserted");
 } else {
     header("Location: adduser.php?failure");
 }
 }
?>
<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
 <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
 <meta name="generator" content="Hugo 0.88.1">
 <title>Penjualan Alat Tulis</title>

 <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-fixed/">

 

 <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

 <style>
   .bd-placeholder-img {
     font-size: 1.125rem;
     text-anchor: middle;
     -webkit-user-select: none;
     -moz-user-select: none;
     user-select: none;
   }

   @media (min-width: 768px) {
     .bd-placeholder-img-lg {
       font-size: 3.5rem;
     }
   }
 </style>

 
 <!-- Custom styles for this template -->
 <link href="navbar-top-fixed.css" rel="stylesheet">
</head>
<body>
 
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
<div class="container-fluid">
 <a class="navbar-brand" href="#">Penjualan Alat Tulis</a>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarCollapse">
   <ul class="navbar-nav me-auto mb-2 mb-md-0">
     <li class="nav-item">
       <a class="nav-link" aria-current="page" href="indexuser.php">Pengelolaan Barang</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="indexuser.php">Pengelolaan User</a>
     </li>
   </ul>
   <div class="d-flex">
     <a href="logout.php"><button class="btn btn-outline-danger">Logout</button></a>
   </div>
 </div>
</div>
</nav>
<br>
<br>
<br>
<main class="container">
 
<div class="bg-light p-5 rounded">
<div class="panel panel-primary">
<a href="indexuser.php" class="btn btn-large btn-secondary btn-sm">Kembali</a>    

<h1 class="panel-heading text-center">Form Tambah Data</h1>
<div class="panel-body">

 <?php
 if (isset($_GET['inserted'])) {
     ?>
     <div class="container">
         <div class="alert alert-info">
             <strong>Info!</strong> Data berhasil tersimpan! Silakan klik di <a href="indexuser.php">sini</a> untuk kembali ke beranda.
         </div>
     </div>
 <?php
 } elseif (isset($_GET['failure'])) {
     ?>
     <div class="container">
         <div class="alert alert-warning">
             <strong>Warning!</strong> Data gagal disimpan !
         </div>
     </div>
 <?php
 }

 ?>

 <div class="clearfix"></div><br />

 <form method='post'>
     <table class='table table-bordered'>
         <tr>
             <td>Nama</td>
             <td><input type='text' name='nama' class='form-control' required maxlength="50"></td>
         </tr>

         <tr>
             <td>Email</td>
             <td><input type='email' name='email' class='form-control' required></td>
         </tr>

         <tr>
             <td>Password</td>
             <td><input type='password' name='password' class='form-control' required></td>
         </tr>

         <tr>
             <td colspan="2">
                 <button type="submit" class="btn btn-primary btn-sm" name="btn-save">Simpan</button>
                 <button type="reset" class="btn btn-danger btn-sm" name="btn-reset">Reset</button> 
                 <br><br>
                 
             </td>
         </tr>
     </table>
 </form>
</div>
<!--End: Panel-body-->

</div>
</div>
</main>

 <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>
