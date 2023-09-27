<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('userclass.php'); 

if(!isset($_SESSION['id'])){
    header('location: home.php');
}else{
    $id = $_SESSION['id'];
    echo $id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Cari Judul: </label>
        <input type="text" name="cari-judul">
        <input type="submit" value="Cari" name="cari">
    </form>
    
    <button onclick="window.location.href='tambah.php'">Buat Cerita Baru</button>

</body>
</html>