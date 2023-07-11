<?php
session_start();
include 'connect.php';

// Check if the 'Reference' parameter is present in the URL query string
if (isset($_GET['Reference'])) {
    $Reference = $_GET['Reference'];
    $query = "SELECT * FROM items WHERE Reference = :reference"; // Replace 'items' with your actual table name
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':reference', $Reference);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the item exists in the database
    if (!$item) {
        echo "Item not found.";
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $size = $_POST['Size'][$Reference];
        $quantity = $_POST['Quantity'][$Reference];
            }

    // Create a new cart item with the item details
    $cartItem = [
        'Reference' => $item['Reference'],
        'ItemLabel' => $item['ItemLabel'],
        'ItemPrice' => $item['ItemPrice'],
        'ItemFront' => $item['ItemFront'],
        'ItemBack' => $item['ItemBack'],
        'Size' => $size[$Reference],
        'Quantity' => $quantity[$Reference]
                // Add other relevant item details as needed
    ];

    // Add the cart item to the cart session variable
    $_SESSION['cart'][] = $cartItem;

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}

// Check if the 'delete' parameter is present in the URL query string
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];

    // Check if the cart session variable is set and not empty
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Remove the item at the specified index from the cart
        unset($_SESSION['cart'][$deleteIndex]);
        // Reset the array keys to ensure continuous numerical indexing
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="index.css"> <!-- Replace with your custom CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light navbar-light pt-2 pb-2 fixed-top ">
            <div class="container-fluid ">
              <a class="navbar-brand ms-5 h1 " href="index.php"><img class="blacklogo" src="./uploads/BlackLogo.png" alt=""></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-center ms-5 ps-5"  id="collapsibleNavbar">
                <ul class="navbar-nav pt-3 pb-3">
                  <li class="nav-item h6 ">
                    <a class="nav-link color  ms-5 ps-5" href="#clothingline">CLOTHINGLINE</a>
                  </li>
                  <li class="nav-item h6 ">
                    <a class="nav-link color  ms-5 ps-5" href="#about">ABOUT</a>
                  </li>
                  <li class="nav-item h6 ">
                    <a class="nav-link color  ms-5 ps-5" href="#Features">FEATURES</a>
                  </li> 
                  <li class="nav-item h6">
                    <a class="nav-link color  ms-5 ps-5" href="#Contact Us">CONTACT US</a>
                  </li>    
                </ul>
              </div>
              <div class="ollapse navbar-collapse justify-content-end">
              <a href="Cart.php" class="text-secondary">  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shop-window" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z"/>
                  </svg></a>
              </div>
            </div>
          </nav>
          <div class="height col-12">

          </div>
          <div class="height col-12">

</div>
<div class="container">
        <h1 class="mb-5">Items :</h1>
        <?php
        // Check if the cart session variable is set and not empty
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $item) {
                echo '
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div id="myCarousel' . $index . '" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="' . $item['ItemFront'] . '" class="img-fluid" alt="Item Image">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="' . $item['ItemBack'] . '" class="img-fluid" alt="Item Image">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel' . $index . '" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel' . $index . '" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-title">' . ' SKU : ' . $item['Reference'] . '</p>
                                <h5 class="card-title">' . $item['ItemLabel'] . '</h5>
                                <div class="form-group">
                                    <label for="selectSize" class="form-label">Select Size:</label>
                                    <select class="form-select" id="selectSize' . $index . '" name="Size[' . $item['Reference'] . ']">
                                    <option selected disabled>Select Size</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                                                                </div>
                                <div class="form-group">
                                    <label for="inputQuantity" class="form-label">Quantity:</label>
                                    <div class="input-group">
                                    <input class="form-control" id="inputQuantity' . $index . '" type="number" value="1" name="Quantity[' . $item['Reference'] . ']">
                                    <div class="input-group-append">
                                            <button class="btn btn-outline-secondary increment-btn" type="button">+</button>
                                            <button class="btn btn-outline-secondary decrement-btn" type="button">-</button>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">Price: ' . $item['ItemPrice'] . ' DH</p>
                                <a href="cart.php?delete=' . $index . '" class="btn btn-danger">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<h3>Cart is empty:</h3>";
            header("Location:index.php");
        }
        ?>
    
        <form method="post" action="submit_order.php">
    <h2>Customer Information</h2>
    <div class="mb-3">
        <label for="inputName" class="form-label">Name</label>
        <input type="text" class="form-control" id="inputName" name="name" required>
    </div>
    <div class="mb-3">
        <label for="inputEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="email" required>
    </div>
    <div class="mb-3">
        <label for="inputPhone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="inputPhone" name="phone" required>
    </div>
    <div class="mb-3">
        <label for="inputLocation" class="form-label">Location</label>
        <input type="text" class="form-control" id="inputLocation" name="location" required>
    </div>
    <div class="mb-3">
        <label for="inputCity" class="form-label">City</label>
        <input type="text" class="form-control" id="inputCity" name="city" required>
    </div>
    <button type="submit" class="btn btn-dark">Submit Order</button>
    <a href="index.php"><button type="button" class="btn btn-dark">Continue Shopping!</button></a>

</form>
<div class="height col-12">

</div>

</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="size.js"></script>
</body>
</html>
