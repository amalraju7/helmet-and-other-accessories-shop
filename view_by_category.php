<?php
include_once("includes/header.php");
include_once("includes/navigation.php");
?>


<?php



$c = $_GET['category'];
$sql="SELECT * FROM product WHERE category= $c AND status = 1 ";

$products = Product::find_by_query($sql);
if(mysqli_affected_rows($database->connection) != 0){ ?> 
<main class="section-products">
<?php
foreach($products as $product){ 

?>
<?php $sql = "SELECT * FROM variant where product_id = '$product->id'   GROUP BY color ";
$variants = Variant::find_by_query($sql);
if( mysqli_affected_rows($database->connection) !=0 )
{
?>
    <div class="product-card">
        <img class="product-card__image" src="<?php
         $images = explode(' ',$variants[0]->images);

         echo "admin/images/" . $images[1]; ?>" alt="">

        <div class="product-card__rating">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill"  xmlns="http://www.w3.org/2000/svg">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
        </div>

        <h1 class="heading-secondary product-card__heading">
           <a  style="color:white;" href="product.php?id=<?php echo $product->id ?>"><?php echo $product->name; ?></a>
        </h1>
        <p class="product-card__price"><i class="fas  fa-rupee-sign"></i><?php echo $variants[0]->selling_price; ?> </p>
        <div class="product-card__sizes">
        <?php 
        $sql = "SELECT * FROM variant where product_id = '$product->id'  GROUP BY size ";
   
        $vis = Variant::find_by_query($sql);
        foreach($vis as $vi) { ?>
            <a class="btn-text btn-small--text ">&nbsp;&nbsp; <?php echo $vi->size; ?> &nbsp;&nbsp;</a>
            <?php } ?>
        
                     
        </div>
        <div class="product-card__color">
            <?php foreach($variants as $variant) { ?>
            <a class="btn-text btn-text--round btn-small" style="background-color:<?php echo $variant->color; ?>;"></a>
            <?php } ?>
              
        </div>

    </div>
<?php } } } else{ ?>
    <div class="search-error-bg d-flex justify-content-center align-items-center">
      <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4 search-error d-flex flex-column justify-content-center align-items-center">
        <img src="https://image.flaticon.com/icons/svg/3003/3003613.svg" alt="searc img" class="img-fluid search-error-img" >
        <p class="search-error-heading text-center">Sorry we couldn't find any matches  <b><?php
        if(isset($_GET['search'])){ echo "for {$_GET['search']}"; } 
        ?></b></p>
        <p class="search-error-text text-center">Please try searching with another term</p>
      </div>
    </div>
<?php } ?>


</main>    
<?php include_once("includes/footer.php"); ?>
<script type="text/javascript" src="js/productImage.js" ></script>
</body>
</html>