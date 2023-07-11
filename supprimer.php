<?php
include 'connect.php';
if(isset($_GET['reference'])){
    $reference = $_GET['reference'];
    $query = "DELETE FROM items WHERE reference = :reference";
    $statement = $conn->prepare($query);
    $statement->execute([
        'reference' => $reference
    ]);

    header("Location:index.php");

}