<?php

include_once("includes/header.php");
include_once("includes/navigation.php");
?>


<?php 
$flage=0;
if(isset($_GET['color'])){
$vari = $_GET['color'];

$vari = explode(',',$vari);

if(count($vari)==2){
   
     $id = $_GET['id'];
     $sql = "SELECT * FROM variant where product_id = '$id' AND color = '#{$vari[0]}' AND size = '{$vari[1]}' ; ";

     $orginal = Variant::find_by_query($sql);
     $orginal = array_shift($orginal);
  
     $flage=1;
}
 }
 ?>

      <main class="section-product">
         
          <div class="productS">
              <div class="productS__wrapper">
                  <img src="img/product/arrow-left.png" alt="" class="productS__arrow arrow-up" >
              <div class="productS__slider">
                  <?php
                  $images = "";
                  $id = $_GET['id'];
                   $sql= " SELECT * FROM `variant` WHERE product_id = '$id'  GROUP BY color  ";
                   $variants = Variant::find_by_query($sql);
                   foreach($variants as $variant){
                       $images .= $variant->images ." ";
                    
                   }
                   $images = explode(' ',$images);
                   foreach($images as $i => $image){
                    ?>
                  <img src="admin/images/<?php echo $image ?>" alt="" class="productS__thumbnail <?php if($i ==0){
                      echo "active";
                  }?>">
            
                   <?php } ?>
              </div>
              <img src="img/product/arrow-right.png" alt="" class="productS__arrow arrow-down">
            </div>
            <div class="productS__featured-box">
                <div  class="productS__lens"></div>
        <img src="admin/images/<?php echo $images[0]?>"  id="lens" class="productS__featured">
    </div>  

    <div class="productD">
    <h1 class="heading-secondary">
     <?php $produc = Product::find_by_id($_GET['id']);
      echo $produc->name; ?>
    </h1>
    <div style="font-size:20px; color:red;"> <?php $bran = Brand::find_by_id($produc->brand); 
    echo $bran->name;

    ?> </div>
   <?php if(isset($_GET['color'])){
    $actual_link;
   if(count($vari)==1){  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $_SESSION['actual_link'] = $actual_link;
   
 }}
    ?>
  
  
    <p class="productD__price"> <?php if(isset($_GET['color'])){ if(count($vari)==2){  echo "<i class='fas  fa-rupee-sign'></i>$orginal->selling_price"; }}?></p>
   
 
<h2>COLOR</h2>
<div class="productD__sizes">
    <?php foreach($variants as $variant){
        $ccolor=trim($variant->color,$variant->color[0]); ?>
    <a class="btn-text btn-text--round <?php if(isset($_GET['color'])){

        $ccc = "#$vari[0]";
        
        if($variant->color == $ccc){
            echo "btn-show";
    } } ?>" href="<?php echo "product.php?id=$id&color=$ccolor" ?>" style="background-color:<?php echo $variant->color; ?>;"></a>
<?php } ?>

</div>
<?php if(isset($_GET['color'])){ if(count($vari)>=1){?>
    <h2>SIZE</h2>
    <div class="productD__sizes">
        <?php 

        $c = $vari[0];
        $sql=" SELECT * FROM variant WHERE product_id=$id AND color ='#$c' ";
        $vs = Variant::find_by_query($sql);
   
        foreach($vs as $v){


        ?>
    <a href="<?php echo "{$_SESSION['actual_link']},$v->size";?> " style="opacity:<?php if($v->quantity == 0){ echo 0.5; } ?> " class="btn-text <?php if(isset($_GET['color'])){
        
        
        if($v->size == $vari[1]){
         
            echo " btn-selected ";
    } } ?>
    ">&nbsp;&nbsp;<?php echo $v->size; ?>&nbsp;&nbsp;</a>
        <?php } ?>
</div>
<?php }} 
?>

<form action="cart.php?id=<?php 

echo $orginal->id; ?> " method="POST" class="productD__button">
    <?php if($flage==1){ ?>

        <?php if($orginal->quantity == 0) { ?>
        <button <?php echo "disabled"; ?> name="cart" class="btn btn--green"> OUT OF STOCK</button>
    <?php } else{ ?>
    <button name="cart" class="btn btn--green">ADD TO CART</button>
    <?php } } else{ ?>
        <button <?php echo "disabled"; ?> name="cart" class="btn btn--green"> SELECT SIZE AND COLOR</button>
    <?php } ?>
</form >
<form action="payment.php?bid=<?php 

echo $orginal->id; ?> " method="POST"  class="productD__button">
<?php if($flage==1){ ?>
    <?php if($orginal->quantity == 0) { ?>
        <button <?php echo "disabled"; ?> name="cart" class="btn btn--yellow"> OUT OF STOCK</button>
        <?php } else{ ?>
<button  name="buy" class="btn btn--yellow">BUY IT NOW</button>
<?php } } else{ ?>
    <button <?php echo "disabled"; ?> class="btn btn--yellow">SELECT SIZE AND COLOR</button>
    <?php } ?>
</form>
</div>


<div class="productF">
   <?php
   $id = $_GET['id'];
   $product  = Product::find_by_id($id);

   
   ?>
    <div >
               
       <p class="productF__details">
           <?php echo $product->description; ?>
       </p>

    </div>

    <button class="collapsible">Features: </button>
    <div class="content">
    <?php echo $product->features; ?>
    </div>
    </div>
</div>

</div>

    </div>
  


      </main> 


</section>

      <?php include_once("includes/footer.php"); ?>
 <script type="text/javascript" src="js/product_slider.js" ></script>
      <script type="text/javascript" src="js/collapsible.js" ></script>


</body>
</html>