<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the customer information from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $city = $_POST['city'];

    // Check if the cart session variable is set and not empty
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Prepare the query to insert the order details into the "orders" table
        $query = "INSERT INTO orders (reference, quantity, size, name, email, phone, location, city) VALUES ";

        $values = [];

        foreach ($_SESSION['cart'] as $index => $item) {
            $values[] = "(:reference$index, :quantity$index, :size$index, :name, :email, :phone, :location, :city)";
        }

        $query .= implode(",", $values);

        $stmt = $conn->prepare($query);

        foreach ($_SESSION['cart'] as $index => $item) {
            $stmt->bindValue(":reference$index", $item['Reference']);
            $stmt->bindValue(":quantity$index", $item['Quantity']);
            $stmt->bindValue(":size$index", $item['Size']);
        }

        // Bind the customer information parameters
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":location", $location);
        $stmt->bindValue(":city", $city);

        // Execute the query
        $stmt->execute();

        // Clear the cart after successful order submission
        unset($_SESSION['cart']);

        // Redirect to a success page or display a success message
        header("Location: success.php");
        exit;
    }
}
?>
