<?php
$servername = 'localhost';
$username = 'root';
$password = '0000';
$dbname = 'mevdata';

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
    echo "error:" . $e->getMessage();
}