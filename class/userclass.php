<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('connection.php'); 
class User{

    private $id;
    private $nama;

    public function __construct()
    {
        $this->id = null;
        $this->nama = null;
    }

    public function Daftar($nrp, $nama, $password){
        $con = ConnectionDb::Connect();

        $salt = str_shuffle("ABCDEfghij");
        $md5pass = md5($password);
        $combinedpass = $md5pass.$salt;
        $finalPassword = md5($combinedpass);

        $sql = "INSERT into users values (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssss", $nrp, $nama, $finalPassword, $salt);
        $stmt->execute();
        $msg = "";
        if(!$stmt->error){
            $msg = "Pendaftaran BERHASIL, silahkan Login";
        }else{
            $msg =  "Pendaftaran GAGAL";
        }
        $con->close();
        return $msg;
    }

    //$nrp adalah id yang dipassing dari input user
    public function Login($nrp, $password){
        $con = ConnectionDb::Connect();

        $sql = "SELECT * from users where idusers=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $nrp);
        $stmt->execute();

        $status = false; //Status keberhasilan login

        $result = $stmt->get_result();
        if($row = $result->fetch_assoc()){
            $salt = $row['salt'];
            $md5pass = md5($password);
            $combinepass = $md5pass.$salt;      
            $finalpassword = md5($combinepass);

            if($finalpassword===$row['password']){
                
                $_SESSION['id'] = $nrp;
                $status = true;
                return $status;
            }else{
                $_SESSION['flash_message'] = "Password Salah";
                return $status;
            }
        }else{
            $_SESSION['flash_message'] = "User tidak ditemukan";
            return $status;
        }
        $con->close();
    }

    public function __destruct()
    {
        
    }
}

?>