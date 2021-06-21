<?php
    require '../includes/common.php';
    if(isset($_SESSION['email']))
        header('location: products.php');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lifestyle Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            #banner-image {
                padding-top: 75px;
                padding-bottom: 50px;
                text-align: center;
                color: #f8f8f8;
                background: url(../images/intro-bg_1.jpg) no-repeat center center;
                background-size: cover;
                margin-bottom: 2%;
            }
            #banner-content {
                position: relative;
                padding-top: 5%;
                padding-bottom: 5%;
                margin: auto;
                margin-top: 12%;
                margin-bottom: 12%;
                background-color: rgba(0, 0, 0, 0.7);
                max-width: 600px;
            }
            .explore a {
                text-decoration: none;
            }
            .explore a:hover {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <?php   include '../includes/header.php';  ?>
        <div id="banner-image" >
            <div class="container">
                <div id="banner-content">
                    <h1>We Sell Lifestyle</h1>
                    <p>Flat 40% off on premium brands.</p>
                    <a href="products.php" class="btn btn-danger btn-lg active">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="container explore">
            <div class="row">
                <div class="col-sm-4">
                    <a href="products.php" class="thumbnail"><img src="../images/1.jpg">
                        <center>
                    <div class="caption">
                        <h3>Cameras</h3>
                        <p>Choose among the best available in the world.</p>
                    </div>
                        </center>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="products.php" class="thumbnail"><img src="../images/7.jpg">
                        <center>
                    <div class="caption">
                        <h3>Watches</h3>
                        <p>Original watches from the best brands.</p>
                    </div>
                        </center>
                    </a>
                </div>
                <div class="col-sm-4">
                    <a href="products.php" class="thumbnail"><img src="../images/8.jpg">
                    <center>
                     <div class="caption">
                        <h3>Shirts</h3>
                        <p>Our exquisite collection of shirts.</p>
                    </div>
                    </center>
                    </a>
                </div>
            </div>
        </div>
        <?php   include '../includes/footer.php';  ?>
    </body>
</html>
