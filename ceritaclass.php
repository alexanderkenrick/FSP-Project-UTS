<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Cerita{

    private $idCerita;
    private $judul;
    private $pembuat;

    public function __construct()
    {
        $this->idCerita = null;
        $this->judul = null;
        $this->pembuat = null;
    }

    public function setIdCerita($idCerita)
    {
        $this->idCerita = $idCerita;
    }

    public function getIdCerita()
    {
        return $this->idCerita;
    } 

    public function setJudul($judul)
    {
        $this->judul = $judul;
    } 

    public function getJudul()
    {
        return $this->judul;
    }
    
    public function setPembuat($pembuat)
    {
        $this->pembuat = $pembuat;
    }

    public function getPembuat()
    {
        return $this->pembuat;
    }

    public function TotalData($keyword){
        $con = new mysqli('localhost', 'root', '', 'fsp-cerita');

        $stmt = $con->prepare("SELECT * from cerita where judul like ?");
        $stmt->bind_param('s', $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        $totalData = $result->num_rows;

        return $totalData;
    }
    
    public function DaftarCerita($keyword, $currentPage, $perpage){
        $con = new mysqli('localhost', 'root', '', 'fsp-cerita');
        
        $startLimit = ($currentPage - 1) * $perpage;

        $sql = "SELECT c.judul, u.nama, c.idcerita from cerita as c INNER JOIN users as u on c.idusers_pembuat_awal = u.idusers where c.judul like ? limit ?,?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sii', $keyword, $startLimit, $perpage);
        $stmt->execute();
        $result = $stmt->get_result();
        $ceritaArr = [];
        while($row = $result->fetch_assoc()){
            $cerita =  new Cerita();
            $cerita->setIdCerita($row['idcerita']);
            $cerita->setJudul($row['judul']);
            $cerita->setPembuat($row['nama']);
            $ceritaArr[] = $cerita;
        }
        return $ceritaArr;
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