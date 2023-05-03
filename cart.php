<?php include_once("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {header('Location: login.php');} ?>
<?php

include_once("includes/navigation.php");
?>


<?php
if($session->is_signed_in()){
if(isset($_POST['cart'])){

    $variant_id = $_GET['id'];
   $sql = "SELECT * FROM `cart` WHERE `variant_id` = '$variant_id' and status='cart' ";
   $cs = Cart::find_by_query($sql);
   echo mysqli_affected_rows($database->connection);
    if(mysqli_affected_rows($database->connection) == 0){

 
    $cart = new Cart();
    $cart->variant_id = $variant_id;
    $cart->user_id = $session->user_id;
    $cart->quantity = 1;
    $cart->date = date("d/m/Y");
    $cart->status = "cart";
    
    $cart->save();

    redirect("cart.php");

    }
}
}

    

if(isset($_POST['update'])){
$sql = "SELECT * FROM `cart` WHERE `variant_id` = '{$_GET['variant']}' AND status='cart'";


    $cart = Cart::find_by_query($sql);
    $cart = array_shift($cart);
    $cart->quantity = $_POST['quantity'];
    $cart->save();
    redirect("cart.php");
}


?>

    <main >

    <?php
    $user_id = $session->user_id;
    $total=0;
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND status='cart' ";
    $carts = Cart::find_by_query($sql);
    if(mysqli_affected_rows($database->connection) != 0) {
    ?>
    <h1 class="heading-secondary"> Shopping Cart</h1>
    <div class="cart-wrapper">
    <table class="cart">
        <tr class="cart-headings">
            <th>Product</th>
        
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th></th>
        </tr>
<?php 

foreach($carts as $cart){
    $variant_id = $cart->variant_id;
 $variant = Variant::find_by_id($variant_id);
 $product = Product::find_by_id($variant->product_id);
 $total = $total + $variant->selling_price * $cart->quantity;
 ?>
        <tr class="cart-product">
            <td class="cart-product__info"> <div class="cart-product__imagebox"> <img class="cart-product__image" src="<?php

         $images = explode(' ',$variant->images);

         echo "admin/images/" . $images[1]; ?>" alt=""></div>
            <p class="cart-product__name "><?php echo "$product->name <br> Color: <input type='color'value='$variant->color' > Size: $variant->size "; ?></p> </td>
        
            <td class="cart-product__price"><?php echo $variant->selling_price; ?></td>
            <?php if($variant->quantity > 0){ ?>
            
                <td class="cart-product__quantity"><form  action="cart.php?variant=<?php echo $variant->id; ?>" method="POST"><input class="rounded-lg" type="number" min="1" max="<?php echo $variant->quantity; ?>" name="quantity" value="<?php echo $cart->quantity; ?>"> <input name="update" value="update" type="submit"> </form></td>
            <?php } else {  ?>
                <td style="color:red;" class="cart-product__quantity">Out Of Stock</td>
            <?php } ?>
                <td class="cart-product__total"><?php echo $variant->selling_price * $cart->quantity; ?></td>
            <td> <a href="deletecart.php?id=<?php echo $cart->id; ?>">Delete</a>   </td>
        </tr>
        <?php }  ?>

    </table>

    <table class="total">
        <tr class="total-headings">
           
            <th colspan="2">Cart Total</th>
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
                <a href="payment.php" class="btn btn--green">Proceed to Checkout!</a>
                  </td></tr> 
                    
                    
                    
                
    </table>
</div>
            <?php }  else {?>
                <div id='oxy-shopping-cart-wrapper'>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.5 22h-9.5v-14h3v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h3v5.181c.482-.114.982-.181 1.5-.181l.5.025v-7.025h-5v-2c0-2.209-1.791-4-4-4s-4 1.791-4 4v2h-5v18h12.816c-.553-.576-1.004-1.251-1.316-2zm-5.5-18c0-1.654 1.346-3 3-3s3 1.346 3 3v2h-6v-2zm16 15.5c0 2.485-2.017 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.017-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-3.086-2.122l-1.414 1.414-1.414-1.414-.707.708 1.414 1.414-1.414 1.414.707.708 1.414-1.414 1.414 1.414.708-.708-1.414-1.414 1.414-1.414-.708-.708z"/></svg>
  <p>There is no products<br/>in the cart</p>
  <a href='index.php'>RETURN TO SHOP</a>
</div>
                


            <?php } ?>
</main>

<?php include_once("includes/footer.php"); ?>
</body>
</html>