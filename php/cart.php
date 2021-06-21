<?php
    require '../includes/common.php';
    if(!isset($_SESSION['email']))
        header('location: login.php');
    
?>
!DOCTYPE html>
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
        
        <div class="container" style="margin-top: 80px;max-width:550px;">
        <?php
            $user_id = $_SESSION['user_id'];
            $sql_query = "select items.id , items.name , items.price , items.image_source from users_items inner join items on users_items.item_id=items.id where user_id='$user_id' and status='Added to cart';";
            $submit_query = mysqli_query($con , $sql_query) or die(mysqli_error($con));
            $count = mysqli_num_rows($submit_query);
            
            if($count==0)
            {
                echo "<div class='jumbotron text-center' style='margin-bottom:270px;'> <h3>Your cart is empty!!</h3> 
                    <br/> <a href='products.php' class='btn btn-success'>Add items</a>
                    </div>
                </div>";
            }
            else
            { 
                $sum = 0; $num = 1; $items = "";
                while($row = mysqli_fetch_array($submit_query))
                {
                $price = $row['price'];
                $pro_name = $row['name'];
                $item_id = $row['id'];
                $items .= ("$item_id".",");
                $src = $row['image_source'];
                echo "<div class='card mb-3 text-center' style='max-width: 640px;border:1px solid black;padding:10px;margin-bottom:10px;border-radius:10px;'>
                    <div class='row no-gutters'>
                      <div class='col-md-4'>
                        <img src='$src' class='card-img' height='150' width='170'>
                      </div>
                      <div class='col-md-8'>
                        <div class='card-body'>
                          <h3 class='card-title'>$pro_name</h3><br>
                          <h5 class='card-text'>Price : Rs $price</h5>
                          <a href='cart-remove.php?id=$item_id' class='btn btn-danger'>Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>";
                    //$sum += $price;
                    $num += 1;
                } ?>
            <?php 
                foreach($_SESSION['cart_items'] as $k => $v)
                {
                    $arr = $_SESSION['cart_items'][$k];
                    $sum += $arr['price'];
                }
            ?>
        </div>
            <div class="container text-center" style="margin-bottom:30px;margin-top: 20px;max-width: 600px;">
                
                <table class="table table-hover table-striped table-bordered text-center">
                    <tr>
                        <td>Sub Total</td>
                        <td>Rs <?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <td>Apply Coupon</td>
                        <td>
                            <div style="display: inline-flex;">
                                <input id="coupon" type="textbox" placeholder="Enter coupon code" style="margin-right: 5px;">
                                <button onclick="setcoupon()" class="btn btn-sm btn-success">Apply coupon</button>
                            </div>
                            <?php if(isset($_SESSION['coupon_code'])) { echo "<p class='text-success' style='margin-top:5px;'>".$_SESSION['coupon_code']." applied successfully.";} ?>
                        </td>
                    </tr>
                    <?php if(isset($_SESSION['discount'])) {
                        $sum -= $_SESSION['discount'];
                        $discount = $_SESSION['discount'];
                        echo "<tr>
                            <td>Discount</td>
                            <td>Rs $discount</td>
                            </tr>";
                    } ?>
                    <tr>
                        <td>Shipping Charges <span data-toggle="tooltip" title="Free shipping on orders above Rs 4999" class="glyphicon glyphicon-exclamation-sign"></span></td>
                        <?php if($sum>=5000)
                        $ship_charge = 0; 
                        else $ship_charge = 149; 
                        $sum += $ship_charge; ?>
                        <td>Rs <?php echo $ship_charge; ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>Rs <?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a <?php echo "href='success.php?items=$items'";?> class="btn btn-success">Check Out</a></td>
                    </tr>
                </table>
            </div>
      <?php } ?>
        <?php   include '../includes/footer.php';  ?>
        <script type='text/javascript'>
            function setcoupon()
            {
                var coupon_str = document.getElementById("coupon").value;
                if(coupon_str!='')
                {
                    jQuery.ajax({
                        url : 'apply_coupon.php',
                        type : 'post',
                        data : 'coupon_str='+coupon_str ,
                        success:function(result) {
                            alert(result);
                            location.reload();
                        }
                    });
                }
                else
                {
                    alert('Invalid Coupon code');
                }
            }
        </script>
        <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
        </script>
    </body>
</html>

<!-- Authentication cart_exp2 me table wala h -->