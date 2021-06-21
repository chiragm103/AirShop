<?php
    require '../includes/common.php';
    if(isset($_SESSION['email']))
        header('location: products.php');
    
    if(!isset($_GET['email']))
        header('location: signup.php');
    
    $email = mysqli_real_escape_string($con , $_GET['email']);
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
        <div class="container">
            <div class="row" style="margin:auto;margin-top:75px;margin-bottom: 55px;max-width:500px;">           
                <div class="panel panel-primary" style="border: 1px solid black;">
                    <div class="panel-heading text-center" style="background-color: black;">
                        <h3><i>Confirm Email id</i></h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($_GET['otp_error'])) 
                        { 
                            $error = $_GET['otp_error'];
                            echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            '.$error.' <button type="button" class="close" data-dismiss="alert">&times;</button> 
                          </div>';
                        } ?> 
                        <p class="text-success">Enter OTP sent to <?php echo $email; ?></p>
                        <form method=post action="confirm_email_script.php?email=<?php echo $email; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" name="otp" placeholder="Enter otp" required>
                            </div>                          
                            
                            <div class="form-group text-center">
                                <button class="btn btn-success btn-block">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
