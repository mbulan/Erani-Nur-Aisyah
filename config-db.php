<?php

try {

    $con = new PDO('mysql:host=localhost;dbname=alat_tulis', 'root', '', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {

    echo $e->getMessage();
}

include_once 'auth.php';
include_once 'barang_class.php';
include_once 'user_class.php';

$user = new Auth($con);
$brg = new barang($con);
$kelolauser = new user($con);
?> 