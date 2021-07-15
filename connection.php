<?php


function connect() {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "A123456*.a4";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    $conn->query("USE reminder;");
    return $conn;
}


?>