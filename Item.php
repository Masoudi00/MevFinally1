<?php
include 'connect.php';

if(isset($_GET['Reference'])){
$Reference = $_GET['Reference'];
}
$sql = "SELECT * FROM Items where Reference = :Reference";
$stmnt = $conn->prepare($sql);
$stmnt->execute([
    'Reference' => $Reference
]);
$exercice = $stmnt->fetch(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM items";
$var = $conn->prepare($sql);
$var->execute();

$rows_produits = $var->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<link rel="stylesheet" href="index.css">
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
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $exercice['ItemFront']; ?>" class="card-img-top mb-5 mb-md-0" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $exercice['ItemBack']; ?>" class="card-img-top mb-5 mb-md-0" alt="Image 2">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
            <form action="Cart.php" method="GET">
                  <div class="small mb-1">SKU: <?php echo $exercice['Reference']; ?></div>
                  <h1 class="display-5 fw-bolder"><?php echo $exercice['ItemLabel']; ?></h1>
                  <div class="fs-5 mb-5">
                      <span class="text-secondary"><?php echo $exercice['ItemPrice']; ?> DH</span>
                  </div>
                  <br>
                  <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                      <i class="bi-cart-fill me-1"></i>
                      Add to Cart
                  </button>
                  <input type="hidden" name="Reference" value="<?php echo $exercice['Reference']; ?>">
            </form>
            </div>
        </div>
    </div>
</section>
<div class="text-center" id="clothingline">
<h1>Related Items:</h1>

    <div class="container">
        <div class="row mt-5 mr-2 ml-2 justify-content-center">
            <?php foreach ($rows_produits as $rows): ?>
                <div class="card col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div id="myCarousel<?php echo $rows['Reference']; ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $rows['ItemFront']; ?>" class="card-img-top" alt="Image 1">
                            </div>
                            <div class="carousel-item">
                                <img src="<?php echo $rows['ItemBack']; ?>" class="card-img-top" alt="Image 2">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel<?php echo $rows['Reference']; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel<?php echo $rows['Reference']; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $rows['ItemLabel']; ?></h5>
                        <p class="card-text text-secondary"><?php echo $rows['ItemPrice']; ?> DH</p>
                       <a href="Item.php?Reference=<?php echo $rows['Reference']; ?>"> <button class="btn btn-dark" style="font-weight: bold;">Buy It Now</button></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="container-fluid p-5 text-white ddd5 mb-5 mt-5" style="background-color:#000000;">
    <div class="row text-center">
      <div class="col-lg-4 mt-4">
        <h2 class="text-white">Reach at..</h2 >
      <p class="text-white mt-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
          <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
        </svg>2215 John Daniel Drive clark
      </p>
      <p class="text-white mt-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg>
        + 0 19 52 54 54 88
    </p>
    <p class="text-white mt-4">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
        <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z"/>
        <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z"/>
      </svg>      
      Mev-Contact@gmail.com
   </p>
      </div>

      <div class="col-lg-4 mt-4 mb-5">
        <h4 class="text-white mb-5">'AROUND THE WEB'</h4>
        <a href="#" class="me-2 ms-2 dd text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
        </svg>
        </a>
        <a href="" class="me-2 ms-2 dd text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </svg>
        </a>
        <a href="" class="me-2 ms-2 text-white  ">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </svg>          
        </a>
      </div>
      <div class="col-lg-4 mt-4">
        <h4 class="text-white">'Subscribe'</h4>
        <label for="exampleInputEmail1" class="form-label"></label>
        <input type="email" class="form-control" placeholder="EmailAdress"required >
        <button type="submit" class="btn btn-dark mt-3">Submit</button>
      </div>
    </div>
  <div style="background-color:#000000;height: 80px; line-height: 80px;" class="text-center"> 
    <p class="text-white">Copyright © Your Website 2023 "Masoudi"</p>
  </div>

 </div>

  </body>
</html>

