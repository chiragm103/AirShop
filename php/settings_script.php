<?php
    require '../includes/common.php';
    if(!isset($_SESSION['email']))
        header('location: login.php');
    
    $email =  mysqli_real_escape_string($con , $_POST['email']);
    $old_password =  mysqli_real_escape_string($con , $_POST['old_password']);
    $new_password =  mysqli_real_escape_string($con , $_POST['new_password']);
    $confirm_password =  mysqli_real_escape_string($con , $_POST['confirm_password']);
    $user_id = $_SESSION['user_id'];
    
    if($email!=$_SESSION['email'])
    {
        header ('location:settings.php?email_error=Invalid Email.');
    }
    else if($new_password!=$confirm_password)
    {
        header ('location:settings.php?password_mismatch=New password and Confirm password do not match.');
    }
    else
    {
        $sql_query = "SELECT password FROM users where email ='$email' and id='$user_id' and status='verified';";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($submit_query);
        if($row['password']==$old_password)
        {
            $sql_query = "update users set password='$new_password' where email ='$email' and id='$user_id';";
            $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
            header('location: products.php');
        }
        else
        {
            header ('location:settings.php?password_error=Old password does not match.');
        }
    }
?>
