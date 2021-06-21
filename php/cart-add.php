<?php
    require '../includes/common.php';
    if(!isset($_SESSION['email']))
        header('location: index.php');
    
    $item_id =  mysqli_real_escape_string($con , $_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    $sql_query = "INSERT INTO users_items(user_id, item_id, status , quantity) VALUES('$user_id', '$item_id', 'Added to cart' , 1);";
    $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
    
    if(!isset($_SESSION['cart_items']))
    {
        $_SESSION['cart_items'] = array();
    }
    $sql_query = "select * from items where id='$item_id'";
    $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($submit_query);
    $arr = array("price"=>$row['price']);
    
    
    $_SESSION['cart_items'] += array($item_id => $arr);
    header('location: products.php');
?>

