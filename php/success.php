<?php
    require '../includes/common.php';
    if(!isset($_SESSION['email']))
        header('location: index.php');
    if(!isset($_GET['items']))
        header('location: cart.php');
     
    $item_ids =  mysqli_real_escape_string($con , $_GET['items']);
    $user_id = $_SESSION['user_id'];
    
    $item_ids = substr($item_ids , 0 , -1);
    $id = strtok($item_ids , ",");
    while($id!==false)
    {
        $sql_query = "update users_items set status='Successful' where user_id='$user_id' and item_id='$id' and status='Added to cart';";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $id = strtok(",");
    }
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
        <?php include '../includes/header.php'; ?>
        <div class='container' style="margin-top: 50px;">
            <div class='jumbotron text-center'>
                <h3 class='text-success'>Your order is confirmed. Thank you for shopping with us.<br/><br/>
                <a href='products.php'>Click here</a> to purchase any other item.</h3>
            </div>
        </div>
    </body>
</html>
