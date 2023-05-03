<?php
include_once("includes/header.php");
include_once("includes/navigation.php");
?>
<?php $user = User::find_by_id($session->user_id); ?>
<section class="section-orders">
<h1 class="order__heading-primary">Your Orders</h1>
<?php 
$sql = "SELECT * FROM order_master WHERE cust_id = $session->user_id ";
$oms = Order_master::find_by_query($sql);
foreach($oms as $om){ 
    $sql = "SELECT * FROM payment WHERE master_id = $om->id";
    $pay = Payment::find_by_query($sql);
    $pay = array_shift($pay);
    $address = Address::find_by_id($pay->address_id);
    ?>
<div class="order__container">
<div class="order__master">
<h4 class="order__heading">Order Number</h4>
<h4 class="order__heading">Date</h4>
<h4 class="order__heading">Total</h4>
<h4 class="order__heading">Address</h4>

<p class="order__paragraph">#A915Afle4fo<?php echo $om->id; ?>  </p>
<p class="order__paragraph"><?php echo $om->date; ?></p>
<p class="order__paragraph"><?php echo $om->total_amount; ?></p>
<p class="order__paragraph"><?php if(mysqli_affected_rows($database->connection) != 0){ echo "$address->address_fname  $address->address_lname  <br>  $address->house
<br>  $address->city ,  $address->district <br>  $address->state  ,  $address->pin <br>  $address->phone_no";}
else{
    echo "Address Deleted";
} ?> </p>

</div>


<div class="order__child ">
   <div class="order__status">
<h4 class="order__heading green "><?php echo $om->status; ?></h4>
<p class="order__paragraph order__sttus"><?php echo $om->expected; ?></p></div> 
<?php
$sql = "SELECT * FROM order_child WHERE master_id = $om->id";


$ocs = Order_child::find_by_query($sql);
foreach($ocs as $oc){ 
    ?>
<div class="order__details">
<h4 class="order__heading"><?php echo $oc->quantity; ?> x <?php 
$v = Variant::find_by_id($oc->item_id);

$p = Product::find_by_id($v->product_id);
echo "$p->name  <br>";

?>
<br>
</h4>
<p class="order__color">Color: <?php echo "<input type='color' value='$v->color'>"; ?></p>
<p class="order__size">Size: <?php echo $v->size; ?></p>
<p class="order__price">Price : ₹<?php echo $oc->rate; ?></p>
<a href="product.php?id=<?php echo $p->id;?>" class="order__button btn btn--green ">Buy It Again</a>

</div>
<hr>
<?php } ?> 




</div>
</div>

<?php } ?>
</section>
          <?php include_once("includes/footer.php"); ?>
          <script type="text/javascript" src="js/collapsible.js" ></script>
</body>
</html>