<?php

class dbObj
{
    var string $servername = "";
    var string $username = "";
    var string $password = "";
    var string $dbname = "";

    var $conn;

    function getConnstring()
    {
        $con = mysqli_connect($this->servername,
            $this->username,
            $this->password,
            $this->dbname)
        or die("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->conn = $con;
        }
        return $this->conn;
    }
}
