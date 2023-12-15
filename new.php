<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('class/userclass.php'); 
require_once('class/ceritaclass.php'); 

if(!isset($_SESSION['id'])){
    header('location: index.php');
}else if(isset($_GET['cerita'])){
    $idCerita = $_GET['cerita'];
}else{
    $idUser = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Cerita</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    
</style>
<body>
    
    <form action="tambah.php" method="post">

        <div class="content-new">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" required>
            <label for="paragraf">Paragraf 1:</label>
            <textarea name="paragraf" id="txtParagraf" placeholder="" maxlength="100" required></textarea> 
            <input type="submit" value="Simpan" name="simpan">
        </div>
        
    </form>
    <a href="home.php"><< Kembali ke Halaman Awal</a>
    <?php
        if(isset($_POST['simpan'])){
            $judul = strtoupper(htmlspecialchars(addslashes($_POST['judul'])));
            $paragraf = htmlspecialchars(addslashes($_POST['paragraf']));

            if($judul== '' || $judul==' ' || $paragraf == '' || $paragraf== " "){
                echo "<br> Judul dan paragraf tidak boleh kosong";
                
            }else{
                $cerita = new Cerita();
                $msg = $cerita->TambahCerita($idUser, $judul, $paragraf);
                echo "<br>" . $msg;
            }
        }
    ?>
</body>
</html>