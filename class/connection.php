<?php

class ConnectionDb{
    public static function Connect(){
        // return new mysqli('localhost', 'id21385019_kenrick_wensel', 'Kenrick_Wensel_123', 'id21385019_fspcerbung');
        // return new mysqli('localhost', 'id21748514_fsp_uas_160421023', 'uas_FSP_160421023', 'id21748514_cerbung');
        return new mysqli('localhost', 'root', '', 'fsp-cerita');
    }
}

?>