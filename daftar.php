<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('userclass.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran</title>
</head>
<body>
    <form action="" method="POST">
        <label for="snrp">snrp:</label>
        <input type="text" name="snrp"><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id=""> <br>
        <label for="nama">Nama: </label>
        <input type="text" name="nama" id=""> <br>

        <input type="submit" value="Daftar" name="submit">
    </form>
    <?php
       
       if(isset($_POST['submit'])){

        $snrp = htmlentities(strip_tags($_POST['snrp'])); 
        $password = $_POST['password'];
        $nama = $_POST['nama'];
    
        $user = new User();
        $msg = $user->Daftar($snrp, $nama, $password);
        echo $msg;
    }
    
?>
</body>
</html>

