<?php
function db_connect(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "feedback.db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;

}
?>