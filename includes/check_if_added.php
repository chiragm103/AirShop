<?php
    function check_if_added_to_cart($item_id)
    {
        $con = mysqli_connect("localhost", "root", "", "lifestyle");
        $user_id = $_SESSION['user_id'];
        
        $sql_query = "SELECT * FROM users_items WHERE item_id='$item_id' AND user_id ='$user_id' and status='Added to cart'";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $count = mysqli_num_rows($submit_query);
        if($count>0)
            return 1;
        else
            return 0;
    }
?>
