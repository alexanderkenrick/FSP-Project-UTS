<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('class/userclass.php'); 

if(isset($_SESSION['id'])){
    header('location: home.php');
}
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
        <label for="snrp">nrp:</label>
        <input type="text" name="nrp" required><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="" required> <br>
        <label for="nama">Nama: </label>
        <input type="text" name="nama" id="" required> <br>

        <input type="submit" value="Daftar" name="submit">
    </form>
    <a href="index.php">Log In</a>
    <?php
       
       if(isset($_POST['submit'])){

        $nrp = strip_tags(addslashes($_POST['nrp'])); 
        $password =  strip_tags(addslashes($_POST['password']));
        $nama = strip_tags(addslashes($_POST['nama']));
    
        $user = new User();
        $msg = $user->Daftar($nrp, $nama, $password);
        echo "<br>" . $msg;
    }
    
?>
</body>
</html>

