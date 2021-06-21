<?php 
    require '../includes/common.php';
    if(isset($_SESSION['email']))
        header('location: products.php');
    
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
            <div class="row" style="margin:auto;margin-top:120px;margin-bottom:100px;max-width:500px;">           
                <div class="panel panel-primary" style="border: 1px solid black;">
                    <div class="panel-heading text-center" style="background-color: black;">
                        <h3><i>Login</i></h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($_GET['email_error'])) 
                        { 
                            $error = $_GET['email_error'];
                            echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            '.$error.' <button type="button" class="close" data-dismiss="alert">&times;</button> 
                          </div>';
                        } ?> 
                        <?php if(isset($_GET['password_error'])) 
                        { 
                            $error = $_GET['password_error'];
                            echo '<div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="15" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            '.$error.' <button type="button" class="close" data-dismiss="alert">&times;</button> 
                          </div>';
                        } ?> 
                        <form method=post action="login_submit.php">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <p>Don't have an account! <a href="signup.php">Sign Up</a></p>
                    </div>
                </div>               
            </div>
        </div>
        <?php   include '../includes/footer.php';  ?>
    </body>
</html>