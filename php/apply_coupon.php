<?php
    require '../includes/common.php';
    
    if(isset($_SESSION['discount']))
        $_SESSION['discount'] = 0;
    if(isset($_SESSION['coupon_code']))
        unset($_SESSION['coupon_code']);
    
    $coupon = mysqli_real_escape_string($con , $_POST['coupon_str']);
    $sql_query = "select * from coupons where coupon_code='$coupon';";
    $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
    $count = mysqli_num_rows($submit_query);
    if($count>0)
    {
         $row = mysqli_fetch_array($submit_query);
         $min_value = $row['min_value'];
         $max_discount = $row['max_discount'];
         if(isset($_SESSION['cart_items']))
         {
            $sum = 0;
            foreach($_SESSION['cart_items'] as $k => $v)
            {
                $arr = $_SESSION['cart_items'][$k];
                $sum += $arr['price'];
            }
            if($sum<$min_value)
            {
                $_SESSION['discount'] = 0;
                echo "coupon applicable on orders above ".$min_value.".";
            }
            else
            {
                $_SESSION['discount'] = $max_discount;
                $_SESSION['coupon_code'] = $coupon;
                echo "Coupon applied succesfully. You got Rs ".$max_discount." off.";
            }
         }
         else
         {
            echo 'session me gadbad';
         }
    }
    else
    {
        echo "Coupon does not exist.";
    }
?>

