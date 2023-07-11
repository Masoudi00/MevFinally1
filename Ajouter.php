<?php 
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ItemFront = $_FILES['ItemFront']['name'];
    $ItemBack = $_FILES['ItemBack']['name'];
    $ItemLabel = $_POST['ItemLabel'];
    $ItemPrice = $_POST['ItemPrice'];

    $ItemFrontPath = 'photos/' . $ItemFront;
    $ItemBackPath = 'photos/' . $ItemBack;

    move_uploaded_file($_FILES['ItemFront']['tmp_name'], $ItemFrontPath);
    move_uploaded_file($_FILES['ItemBack']['tmp_name'], $ItemBackPath);

    $query = "INSERT INTO items(ItemFront, ItemBack, ItemLabel, ItemPrice) VALUES (:ItemFront, :ItemBack, :ItemLabel, :ItemPrice)";
    $statement = $conn->prepare($query);
    $statement->execute([
        'ItemFront' => $ItemFrontPath,
        'ItemBack' => $ItemBackPath,
        'ItemLabel' => $ItemLabel,
        'ItemPrice' => $ItemPrice,
    ]);  
    header('Location: Ajouter.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <ul>
        <a href="Accueil.php"><li>Application Produits</li></a>
        <a href="Accueil.php"><li>Accueil</li></a>
        <a href="Ajouter.php"><li>Ajouter Produits</li></a>
        <a href="Quitter.php"><li>Quitter la session</li></a>
    </ul>

    <h1>Add Product</h1>

    <form method="post" enctype="multipart/form-data">

        <label for="ItemFront">FrontPic:</label>
        <input type="file" name="ItemFront"><br><br>

        <label for="ItemBack">BackPic:</label>
        <input type="file" name="ItemBack">

        <label for="ItemLabel">ItemLabel:</label>
        <input type="text" name="ItemLabel"><br><br>

        <label for="ItemPrice">ItemPrice:</label>
        <input type="text" name="ItemPrice"><br><br>

        <button type="submit">Add</button>
    </form>
</body>
</html>
