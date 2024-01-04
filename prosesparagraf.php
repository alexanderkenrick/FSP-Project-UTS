<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('class/userclass.php'); 
require_once('class/ceritaclass.php'); 

if(!isset($_SESSION['id'])){
    header('location: index.php');
}else{
    $idUser = $_SESSION['id'];
}

if(isset($_POST['simpan'])){
    $paragraf = htmlspecialchars(addslashes($_POST['tambah-paragraf']));
    $idCerita = $_POST['idcerita'];

    if($paragraf== '' || $paragraf==' ' || $paragraf == '' || $paragraf== " "){
        $_SESSION['flash_message'] = "Judul dan paragraf tidak boleh kosong";
        header("location: read.php?cerita=".$idCerita);
    }else{
        $cerita = new Cerita();
        $msg = $cerita->TambahParagraf($idUser, $idCerita, $paragraf);

        $_SESSION['flash_message'] = $msg;
        header("location: read.php?cerita=".$idCerita);
    }
}
?>