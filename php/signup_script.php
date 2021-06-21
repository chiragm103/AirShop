<?php
    require '../includes/common.php';
     
    $email =  mysqli_real_escape_string($con , $_POST['email']); //adds a backslash before inverted commas to tell sql to treat it as a string not commas
    $name = mysqli_real_escape_string($con , $_POST['name']);
    $password =  mysqli_real_escape_string($con , $_POST['password']);
    $cnf_password =  mysqli_real_escape_string($con , $_POST['cnf_password']);
    
    if($password!=$cnf_password)
    {
        header('location: signup.php?password_mismatch=Password and Confirm Password do not match');
    }
    else
    {
        $sql_query = "select id from users where(email='$email');";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $count = mysqli_num_rows($submit_query);

        if($count>0)
        {
            header('location: signup.php?email_error=Email already registered.');
        }
        else
        {
            $otp = rand(999999, 111111);
            
            $sql_query = "insert into users(name , email , password , status , otp) values('$name' , '$email' , '$password' , 'not verified' , $otp);";
            $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
            
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
            }
            
?>

