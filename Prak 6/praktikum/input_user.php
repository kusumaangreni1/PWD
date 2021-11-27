<?php

session_start();
if($_POST["captcha_code"] == $_SESSION["captcha_code"]){
    include "koneksi.php";
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $sql = "INSERT INTO user(id_user,password, nama, email) VALUES ('$id_user', '$pass', '$nama','$email')";
    $query=mysqli_query($con, $sql);
    mysqli_close($con); 
    header('location:tampil_user.php');
}
else {
    echo "<center> Captcha tidak sesuai <br>";
    echo "<a href=form_user.php><b>Ulangi Lagi</b></a></center>";
}

?>