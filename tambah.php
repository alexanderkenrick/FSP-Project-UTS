<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('userclass.php'); 
require_once('ceritaclass.php'); 

if(!isset($_SESSION['id'])){
    header('location: home.php');
}else{
    $idUser = $_SESSION['id'];
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
        <label for="judul">Judul:</label>
        <input type="text" name="judul"> <br>
        <label for="paragraf">Paragraf 1:</label>
        <textarea name="paragraf" id="txtParagraf" placeholder="" ></textarea> <br>
        <input type="submit" value="Simpan" name="simpan">
    </form>

    <?php
        if(isset($_POST['simpan'])){
            $judul = strtoupper($_POST['judul']);
            $paragraf = $_POST['paragraf'];

            $cerita = new Cerita();

            $msg = $cerita->TambahCerita($idUser, $judul, $paragraf);
            echo $msg;
        }
    ?>
</body>
</html>