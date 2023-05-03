

<?php ob_start();
 require_once("admin/includes/init.php"); ?>
<?php require_once("admin/includes/functions.php"); ?>
<?php if(!$session->is_signed_in()) {header('Location: login.php');} ?>
<?php $u = User::find_by_id($session->user_id); 
$a = Address::find_by_id($u->address_id);
if(mysqli_affected_rows($database->connection)==0){
    if(isset($_GET['bid'])){
        $bid = $_GET['bid'];
        redirect("address.php?bid=$bid");
    }
    else{
        redirect("address.php");
    }
   
}
$c = Card::find_by_id($u->card_id);
if(mysqli_affected_rows($database->connection)==0){
    if(isset($_GET['bid'])){
        $bid = $_GET['bid'];
        redirect("card.php?bid=$bid");
    }
    else{
        redirect("card.php");
    }
}


?>
<?php
if(isset($_POST['buy'])){
    
        $sql = "SELECT * FROM cart WHERE status='buy'";
        $cs = Cart::find_by_query($sql);
        foreach($cs as $c){
            $c->delete();
        }
        $variant_id = $_GET['bid'];
        $cart = new Cart();
        $cart->variant_id = $variant_id;
        $cart->user_id = $session->user_id;
        $cart->quantity = 1;
        $cart->date = date("d/m/Y");
        $cart->status = "buy";
        
        $cart->save();
   
    }
?>

<?php
if(isset($_GET['aid'])){
    $u->address_id = $_GET['aid'];
    $u->save();
}

if(isset($_GET['cid'])){
    $u->card_id = $_GET['cid'];
    $u->save();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <title>Mactanse | For Riders  </title>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,700;1,500&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/527093011c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/cardslider.js" ></script>

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" media="all" type="text/css"> 
</head>
<body style="background-color:lightgrey " class="wrapper">
 
<section class="section-address">
<h1 class="heading-secondary"> Your Addresses: </h1>
<div class="address__wrapper">
<?php
$sql=" SELECT * FROM address WHERE user_id = '$session->user_id' ";
$addresses = Address::find_by_query($sql);
foreach($addresses as $address){
?>
<?php $u = User::find_by_id($session->user_id); 
        $add_id = $address->id;
        $uadd_id = $u->address_id;
        if($add_id == $uadd_id ){  ?>
    <div style="border: 5px solid red; filter:brightness(1.5); " class="address__card">
        <?php } 
        else {?>
          <div  class="address__card">
        <?php 
        }
        if($add_id == $uadd_id ){ ?>
        <p class="address__seleceted">SELECTED</p> <?php } ?>
    <?php echo $address->address_fname; ?>  <?php echo " $address->address_lname"; ?> <br>
    <?php echo $address->house; ?> <br>
    <?php echo $address->city; ?> <br>
    <?php echo $address->district; ?> <br>
    <?php echo $address->state; ?> <br>
    <?php echo $address->pin; ?> <br>
India <br>
Phone:    <?php echo $address->phone_no; ?>  <br> <br>
<a href="editaddress.php?id=<?php
if(isset($_GET['bid'])){
    $bid = $_GET['bid'];
echo "$address->id&bid=$bid";
}
else{
echo $address->id; } ?>">Edit</a>  <a href="payment.php?aid=<?php
if(isset($_GET['bid'])){
    $bid = $_GET['bid'];
echo "$address->id&bid=$bid";
}
else{
echo $address->id; } ?>">Select</a>
    </div>
<?php } ?>
   
    <div class="address__card">
    <?php if(isset($_GET['bid'])){ ?>


        <a href="address.php?bid=<?php echo $_GET['bid']; ?>">
<?php } else { ?>
    <a href="address.php">
<?php } ?>
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
  <path fill="#61B3C4"
        d="M 38.999, 7
           H 11
           c -2.25, 0,   -4, 1.75,   -4, 4
           v 27.999
           C 7, 41.249,   8.75, 43,   11, 43
           h 27.999
           C 41.249, 43,   43, 41.249,   43, 38.999
           V 11
           C 43, 8.75,   41.249, 7,   38.999, 7
           z"/>
  <path fill="#FFFFFF" 
        d="M 35.001, 26.999
           H 27
           V 35
           h -3.999
           v -8.001
           h -8.002
           V 23
           h 8.002
           v -8
           H 27
           v 8
           h 8.001
           V 26.999
           z"/>
  </svg></a>
    </div>

</div>
</section>
<section class="section-credit">
<h1 class="heading-secondary"> Your Cards: </h1>
<div class="credit__wrapper">
<?php 
$sql="SELECT * FROM card WHERE user_id = $session->user_id ";

$cards = Card::find_by_query($sql);

foreach($cards as $card){


?>



        <?php $u = User::find_by_id($session->user_id); 
        $card_id = $card->id;
        $ucard_id = $u->card_id;
        if($card_id == $ucard_id ){ 
    ?>

        <div style="border: 5px solid red; filter:brightness(1.5); border-radius:28px; " class="creditcard">  <?php } else { ?> <div  class="creditcard">
<?php }
        if($card_id == $ucard_id ){ ?>
       <p class="address__seleceted">SELECTED</p> <?php } ?>

<div class="front">
    <div id="ccsingle"></div>
    <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
        <g id="Front">
            <g id="CardBackground">
                <g id="Page-1_1_">
                    <g id="amex_1_">
                        <path id="Rectangle-1_1_" class="" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                C0,17.9,17.9,0,40,0z" />
                    </g>
                </g>
                <path class="" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
            </g>
            <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber" class="st2 st3 st4"><?php echo $card->card_number; ?></text>
            <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6"><?php echo $card->name; ?></text>
            <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">cardholder name</text>
            <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">expiration</text>
            <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">card number</text>
            <text transform="matrix(1 0 0 1 365.1054 41.5)" class="st7 st5 st8"> <a href="payment.php?cid=<?php 
            
            if(isset($_GET['bid'])){
                $bid = $_GET['bid'];
                echo "$card->id&bid=$bid"; 
            }
            else{
            echo $card->id; 
            } ?>">SELECT</a></text>
            <text transform="matrix(1 0 0 1 485.1054 41.5)" class="st7 st5 st8"> <a href="editcard.php?id=<?php 
            
            if(isset($_GET['bid'])){
                $bid = $_GET['bid'];
                echo "$card->id&bid=$bid"; 
            }
            else{
            echo $card->id; 
            } ?>">EDIT</a></text>

            <g>
                <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="st2 st5 st9"><?php echo $card->expiry; ?></text>
                <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		" />
            </g>
            <g id="cchip">
                <g>
                    <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
            c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                </g>
                <g>
                    <g>
                        <rect x="82" y="70" class="st12" width="1.5" height="60" />
                    </g>
                    <g>
                        <rect x="167.4" y="70" class="st12" width="1.5" height="60" />
                    </g>
                    <g>
                        <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                    </g>
                    <g>
                        <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5" />
                    </g>
                    <g>
                        <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5" />
                    </g>
                    <g>
                        <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5" />
                    </g>
                    <g>
                        <rect x="142" y="117.9" class="st12" width="26.2" height="1.5" />
                    </g>
                </g>
            </g>
        </g>
       
    </svg>
</div>

</div>
<?php } ?>

<div class="address__card">
<?php if(isset($_GET['bid'])){ ?>


        <a href="card.php?bid=<?php echo $_GET['bid']; ?>">
<?php } else { ?>
    <a href="card.php">
<?php } ?>
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="50px" height="50px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
  <path fill="#61B3C4"
        d="M 38.999, 7
           H 11
           c -2.25, 0,   -4, 1.75,   -4, 4
           v 27.999
           C 7, 41.249,   8.75, 43,   11, 43
           h 27.999
           C 41.249, 43,   43, 41.249,   43, 38.999
           V 11
           C 43, 8.75,   41.249, 7,   38.999, 7
           z"/>
  <path fill="#FFFFFF" 
        d="M 35.001, 26.999
           H 27
           V 35
           h -3.999
           v -8.001
           h -8.002
           V 23
           h 8.002
           v -8
           H 27
           v 8
           h 8.001
           V 26.999
           z"/>
  </svg></a>
    </div>


</div>

</section>
   
<?php
if(isset($_POST['cart'])){

    $variant_id = $_GET['id'];
    $cart = new Cart();
    $cart->variant_id = $variant_id;
    $cart->user_id = $session->user_id;
    $cart->quantity = 1;
    $cart->date = date("d/m/Y");
    
    $cart->save();

    redirect("cart.php");
}

if(isset($_POST['update'])){
    if(isset($_GET['bid'])){


$sql = "SELECT * FROM `cart` WHERE `variant_id` = '{$_GET['variant']}' AND status='buy' ";
    }
    else{
        $sql = "SELECT * FROM `cart` WHERE `variant_id` = '{$_GET['variant']}' AND status='cart' ";
    }


    $cart = Cart::find_by_query($sql);
  
    $cart = array_shift($cart);
    $cart->quantity = $_POST['quantity'];
    $cart->save();
  
    if(isset($_GET['bid'])){
        $bid = $_GET['bid'];
        redirect("payment.php?bid=$bid");
    }
    else{
    // redirect("payment.php");
}
}

?>
    <main >

    <h1 class="heading-secondary"> Review Your Order</h1>
    <div class="cart-wrapper">
    <table style="margin:40px;" class="cart">
        <tr class="cart-headings">
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
         
        </tr>
<?php 
$user_id = $session->user_id;
$total=0;
if(isset($_GET['bid'])){
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' and status = 'buy' ";  
}

else{
$sql = "SELECT * FROM cart WHERE user_id = '$user_id' and status = 'cart' ";
}
$carts = Cart::find_by_query($sql);
foreach($carts as $cart){
    $variant_id = $cart->variant_id;
 $variant = Variant::find_by_id($variant_id);
 $product = Product::find_by_id($variant->product_id);
 $total = $total + $variant->selling_price  * $cart->quantity;
 ?>
        <tr class="cart-product">
            <td class="cart-product__info"> <div class="cart-product__imagebox"> <img class="cart-product__image" src="<?php

         $images = explode(' ',$variant->images);

         echo "admin/images/" . $images[1]; ?>" alt=""></div>
          <p class="cart-product__name "><?php echo "$product->name <br> Color: <input type='color'value='$variant->color' > Size: $variant->size "; ?></p> </td>
            <td class="cart-product__price"><?php echo $variant->selling_price; ?></td>

                <?php if($variant->quantity > 0){ ?>
            <?php if(isset($_GET['bid'])){ ?>
                <td class="cart-product__quantity"><form  action="payment.php?variant=<?php 
                $bid = $_GET['bid'];
                echo "$variant->id&bid=$bid"; ?>" method="POST"><input type="number" min="1" max="<?php echo $variant->quantity; ?>" name="quantity" value="<?php echo $cart->quantity; ?>"> <input name="update" value="update" type="submit"> </form></td>
            <?php } else{ ?>
                <td class="cart-product__quantity"><form  action="payment.php?variant=<?php echo $variant->id; ?>" method="POST"><input type="number" min="1" max="<?php echo $variant->quantity; ?>" name="quantity" value="<?php echo $cart->quantity; ?>"> <input name="update" value="update" type="submit"> </form></td>
            <?php } ?>
                <?php } else {  ?>
                <td style="color:red;" class="cart-product__quantity">Out Of Stock</td>
            <?php } ?>
            <td class="cart-product__total"><?php echo $variant->selling_price * $cart->quantity; ?></td>
            
        </tr>
        <?php } ?>

    </table>

    <table style="margin:40px;" class="total">
        <tr class="total-headings">
           
            <th colspan="2"> Total</th>
        </tr>
        <tr class="total-product">
            <td>Subtotal</td>  
            <td><?php echo $total; ?></td>
            </tr>
            <tr  class="total-product">
                <td>Total</td>  
                <td><?php echo $total; ?></td>
                </tr>
            <tr><td colspan="2">
               <?php  if(isset($_GET['bid'])){ ?>
                <a href="pay.php?status=buy" class="btn btn--green">Proceed</a>
               <?php } else if(isset($_GET['variant'])) { ?>
                <a href="pay.php" class="btn btn--green">Proceed</a>
               <?php }  else{ ?>
                <a href="pay.php" class="btn btn--green">Proceed</a>
               <?php } ?>
                  </td></tr> 
                    
                    
                    
                
    </table>
</div>
</main>
</body>
</html>