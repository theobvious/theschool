<?php 

require_once 'data.php';

Class LoginM extends DAL {

    function setQuery($email, $pass) {
        $sql = "SELECT * FROM users WHERE email = '".$email."' AND pass = '".$pass."'";
        $result = $this->fetch($sql);
        $resultArray = $result->fetch(PDO::FETCH_ASSOC);
        return $resultArray;
    }
}
?>