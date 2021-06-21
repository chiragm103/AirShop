
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
    <body>>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.php" class="navbar-brand">Lifestyle Store</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (isset($_SESSION['email'])) {
                            ?>
                            <li> <a href="products.php"><span class="glyphicon glyphicon-th-large"></span> Products </a></li>
                            <li> <a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart </a></li>
                            <li> <a href="my_orders.php"><span class="glyphicon glyphicon-gift"></span> My orders </a></li>
                            <li> <a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings </a></li>
                            <li> <a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log out </a></li>
                            <?php
                        } else {
                            ?>
                            <li> <a href = "signup.php"><span class = "glyphicon glyphicon-user"></span> Sign Up </a></li>
                            <li> <a href = "login.php"><span class = "glyphicon glyphicon-log-in"></span> Login </a></li>
                            <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>