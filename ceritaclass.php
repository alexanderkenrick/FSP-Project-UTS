<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Cerita{

    private $id;
    private $judul;

    public function __construct()
    {
        $this->id = null;
        $this->judul = null;
    }

    public function TambahCerita($idUser, $judul, $paragraf){
        $con = new mysqli('localhost', 'root', '', 'fsp-cerita');

        $sql = "INSERT into cerita values(null, ?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $judul, $idUser);
        $stmt->execute();

        $idCerita = $stmt->insert_id; //Mendapatkan id dari judul cerita yang baru ditambahkan

        $sql2 = "INSERT into paragraf values(?,?,?, now())";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("sis", $idUser, $idCerita, $paragraf);
        $stmt2->execute();

        if($stmt->error){
            $con->close();
            return $stmt->error;
        }elseif($stmt2->error){
            $con->close();
            return $stmt2->error;
        }else{
            $con->close();
            return "Berhasil membuat cerita";
        }
    }

    public function __destruct()
    {
        
    }
}

?>