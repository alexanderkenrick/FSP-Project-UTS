<?php
require_once('class/ceritaclass.php'); 
require_once('class/connection.php'); 

    $con = ConnectionDb::Connect();
    $perpage=4;
    $currentPage= $_POST['currentPage'];

    $startLimit = ($currentPage - 1) * $perpage;

    $idPembuat = $_POST['idPembuat'];
    $sql = "SELECT c.judul, u.nama, c.idcerita, COUNT(p.idparagraf) as jumlahPar  from cerita as c INNER JOIN users as u on c.idusers_pembuat_awal = u.idusers INNER JOIN paragraf as p on p.idcerita = c.idcerita WHERE c.idusers_pembuat_awal = ? GROUP BY idcerita  limit ?,?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iii', $idPembuat , $startLimit, $perpage);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $ceritaArr = [];
    while($row = $result->fetch_assoc()){
        $cerita = new stdClass();
        $cerita->id = $row['idcerita'];
        $cerita->judul = $row['judul'];
        $cerita->pembuat = $row['nama'];
        $cerita->jumlahPar = $row['jumlahPar'];
        $ceritaArr[] = $cerita;
    }

    echo json_encode($ceritaArr);

?>