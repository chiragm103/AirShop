<?php 
    require '../includes/common.php';
    
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
    </head>
    <body>
        <?php   include '../includes/header.php';  ?>
        <?php   include '../includes/check_if_added.php';  ?>
        
        <div class="container">
            <div class="jumbotron" >
                <h1>Welcome to our Lifestyle Store!</h1>
                <p>We have the best cameras, watches and shirts for you. No need to hunt around, we
                    have all in one place.</p>
            </div>
            <?php
                $sql_query = "SELECT * from items;";
                $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($submit_query))
                {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $path = $row['image_source'];
                    if(isset($_SESSION['email']))
                    $email = $_SESSION['email'];
                    echo"<div class='col-md-3 col-sm-6'>
                    <div class='thumbnail'><img src='$path'>                     
                        <div class='caption text-center'>
                            <h3>$name</h3>
                            <p>Price: Rs. $price</p>";
                            
                            if(!isset($email)) { 
                            echo "<p><a href='login.php' role='button' class='btn btn-primary btn-block'>Buy Now</a></p>
                            ";
                                } else {
                                if (check_if_added_to_cart($id)) { 
                                echo "<a href='#' class='btn btn-block btn-success' disabled>Added to 
                               cart</a>";
                                } else {
                            
                            echo "<a href='cart-add.php?id=$id' name='add' value='add' class='btn btn-block 
                            btn-primary'>Add to cart</a>";
                            
                                }
                                }
                            
                        echo "</div>
                    </div>
                  </div>";
                }
            ?>
        </div>
        <?php   include '../includes/footer.php';  ?>
    </body>
</html>