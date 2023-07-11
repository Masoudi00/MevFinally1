    <?php
    include 'connect.php';

    if (isset($_GET['Reference'])) {
        $Reference = $_GET['Reference'];

        $query = "SELECT * FROM Items WHERE Reference = :Reference";
        $statement = $conn->prepare($query);
        $statement->execute([
            'Reference' => $Reference
        ]);
        $product = $statement->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Reference value is missing.";
    }

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $Reference = $_POST['Reference'];
        $ItemFront = $_FILES['ItemFront']['name'];
        $ItemBack = $_FILES['ItemBack']['name'];
        $ItemLabel = $_POST['ItemLabel'];
        $ItemPrice = $_POST['ItemPrice'];


        $ItemFrontPath = 'photos/' . $ItemFront;
        $ItemBackPath = 'photos/' . $ItemBack;

        move_uploaded_file($_FILES['ItemFront']['tmp_name'], $ItemFrontPath);
        move_uploaded_file($_FILES['ItemBack']['tmp_name'], $ItemBackPath);


    
        $query = "UPDATE Items SET ItemFront = :ItemFront, ItemBack = :ItemBack, ItemLabel = :ItemLabel, ItemPrice = :ItemPrice WHERE Reference = :Reference";
        
        $statement = $conn->prepare($query);
        $statement->execute([
            'Reference' => $Reference,  
            'ItemFront' => $ItemFrontPath,
            'ItemBack' => $ItemBackPath,
            'ItemLabel' => $ItemLabel,
            'ItemPrice' => $ItemPrice
        ]);
        header("Location:Accueil.php");
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        
    <input type="text" name="Reference" value="<?php echo $product['Reference']; ?>">
    <br>

    <label for="ItemFront">FrontPic:</label><br>
    <img src="<?php echo $product['ItemFront']; ?>" alt="">
    <input type="file" name="ItemFront"  value="<?php echo $product['ItemFront']; ?>"><br><br>

    <label for="ItemBack">BackPic:</label><br>
    <img src="<?php echo $product['ItemBack']; ?>" alt="">
    <input type="file" name="ItemBack" value="<?php echo $product['ItemBack']; ?>">
    <br>
    <label for="ItemLabel">ItemLabel:</label>
    <input type="text" name="ItemLabel" value="<?php echo $product['ItemLabel']; ?>"><br><br>
    <br>
    <label for="ItemPrice">ItemPrice:</label>
    <input type="text" name="ItemPrice" value="<?php echo $product['ItemPrice']; ?>"><br><br>
    <br>
    <button type="submit">Modifier</button>
    </form>