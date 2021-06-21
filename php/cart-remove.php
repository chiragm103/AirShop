<?php
    require '../includes/common.php';
    if(!isset($_SESSION['email']))
        header('location: index.php');
    if(!isset($_GET['id']))
        header('location: cart.php');
    
    $item_id = mysqli_real_escape_string($con , $_GET['id']);
    $user_id = $_SESSION['user_id'];
    
    $sql_query = "delete from users_items where user_id='$user_id' and item_id='$item_id' and status='Added to cart';";
    $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
    
    unset($_SESSION['cart_items'][$item_id]);
    
    if(isset($_SESSION['coupon_code']))
    {
        $sum = 0;
        foreach($_SESSION['cart_items'] as $k => $v)
        {
            $arr = $_SESSION['cart_items'][$k];
            $sum += $arr['price'];
        }
        $coupon = $_SESSION['coupon_code'];
        $sql_query = "select * from coupons where coupon_code='$coupon';";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($submit_query);
        echo "min to apply coupon ".$row['min_value']."   sum = ".$sum;
        if($row['min_value']>$sum)
        {
            unset($_SESSION['discount']);
            unset($_SESSION['coupon_code']);
        }
    }
            
    header('location: cart.php');
?>

