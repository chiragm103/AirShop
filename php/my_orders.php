<?php
    require '../includes/common.php';
    if(!isset($_SESSION['email']))
        header('location: index.php');
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
        <?php   include '../includes/check_if_added.php';  ?>
        
        <?php
        $user_id = $_SESSION['user_id'];
        $sql_query = "select items.id , items.name , items.image_source from users_items inner join items on users_items.item_id=items.id where user_id='$user_id' and status='Successful';";
        $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
        $count = mysqli_num_rows($submit_query);
        if($count==0)
        {
            echo "<div class='container' style='margin-top: 120px;max-width:550px;'>
                <div class='jumbotron text-center'> <h3>You have not placed any order yet!!</h3> 
                    <br/> <a href='products.php' class='btn btn-success'>Buy items</a>
                    </div>
                </div>
                </div>";
        }
        else
        {
            echo "<div class='container'><div class='jumbotron text-center'><h3 class='text-success'> You can see all your placed orders here</h3> </div></div>";
            echo "<div class='container'>";
            while($count-->0)
            {
                $row = mysqli_fetch_array($submit_query);
                $id = $row['id'];
                $name = $row['name'];
                $path = $row['image_source'];
                echo"<div class='col-md-3 col-sm-6'>
                        <div class='thumbnail'><img src='$path'>                     
                            <div class='caption text-center'>
                                <h3>$name</h3>";


                                    if (check_if_added_to_cart($id)) { 
                                    echo "<a href='#' class='btn btn-block btn-success' disabled>Added to 
                                   cart</a>";
                                    } else {

                                echo "<a href='cart-add.php?id=$id' name='add' value='add' class='btn btn-block 
                                btn-primary'>Buy Again</a>";

                                    }

                            echo "</div>
                        </div>
                      </div>";
            }
            echo "</div>";
        }
        ?>
        
    </body>
</html>

