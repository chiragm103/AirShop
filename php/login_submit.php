<?php
    require '../includes/common.php';
     
    $email =  mysqli_real_escape_string($con , $_POST['email']);
    $password =  mysqli_real_escape_string($con , $_POST['password']);
    
    $sql_query = "select id from users where(email='$email');";
    $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
    $count = mysqli_num_rows($submit_query);
    if($count==0)
    {
        header ('location:login.php?email_error=Email not registered.');
    }
    else
    {
        $sql_query = "select id , email , status , otp from users where(email='$email' and password='$password');";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($submit_query);
        $count = mysqli_num_rows($submit_query);
            if($count<=0)
            header ('location:login.php?password_error=Wrong Password.');
            else
            {
                if($row['status']=='not verified')
                {
                    $otp = $row['otp'];
                    
                    $subject = "Otp for verification";
                    $message = "Your verification code is $otp";
                    $sender = "From: funimation333@gmail.com";

                    include('../smtp/PHPMailerAutoload.php');
                        $mail=new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host="smtp.gmail.com";
                        $mail->Port=587;
                        $mail->SMTPSecure="tls";
                        $mail->SMTPAuth=true;
                        $mail->Username="funimation333@gmail.com";
                        $mail->Password="chiragm103@";
                        $mail->SetFrom("funimation333@gmail.com");
                        $mail->addAddress($email);
                        $mail->IsHTML(true);
                        $mail->Subject=$subject;
                        $mail->Body=$message;
                        $mail->SMTPOptions=array('ssl'=>array(
                                'verify_peer'=>false,
                                'verify_peer_name'=>false,
                                'allow_self_signed'=>false
                        ));
                        if($mail->send()){
                            header("location: confirm_email.php?email=$email");
                        }else{
                                echo "Error occur";
                        }
                }
                else
                {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_id'] = $row['id'];
                    $id = $row['id'];
                    
                    
                    $sql_query = "select items.id , items.name , items.price from items inner join users_items on users_items.item_id=items.id where users_items.user_id='$id' and users_items.status='Added to cart';";
                    $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
                    
                    $_SESSION['cart_items'] = array();
                    while($row = mysqli_fetch_array($submit_query))
                    {
                        $arr = array("price"=>$row['price']);
                        $_SESSION['cart_items'] += array($row['id'] => $arr);
                    }
                    
                    header('location: products.php');
                }
            }
        } 
?>

