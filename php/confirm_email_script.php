<?php
    require '../includes/common.php';
    if(isset($_SESSION['email']))
        header('location: products.php');
    
    if(!isset($_GET['email']))
        header('location: signup.php');
    if(!isset($_POST['otp']))
        header('location: signup.php');
    
    $entered_otp = mysqli_real_escape_string($con , $_POST['otp']);
    $email = mysqli_real_escape_string($con , $_GET['email']);
    
    $sql_query = "select id from users where email='$email' and status='not verified' and otp='$entered_otp';";
    $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
    $count = mysqli_num_rows($submit_query);
    if($count==0)
    {
        header("location: confirm_email.php?email=$email&otp_error=Incorrect OTP");
    }
    else
    {
        $sql_query = "update users set status='verified' , otp='0' where email='$email' and status='not verified' and otp='$entered_otp';";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        
        $sql_query = "select id from users where email='$email' and status='verified';";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($submit_query);
        
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $row['id'];
        
        header('location: products.php');
    }
?>

