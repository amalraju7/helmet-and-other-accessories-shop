<nav class="navigation">
  
<label for="btn" class="icon">
        <span class="fa fa-bars"></span>
      </label>
      <input class="navigation__checkbox" type="checkbox" id="btn">
      <ul class="navigation__items">
<li><a href="index.php">Home</a></li>
<li>
          <label for="btn-1" class="show">Brands +</label>
          <a href="#">Brands</a>
          <input class="navigation__checkbox" type="checkbox" id="btn-1">
          <ul>
              <?php
              $brands = Brand::find_all(); 
              foreach($brands as $brand){
                  
              ?>

<li><a href="view_by_brand.php?brand=<?php echo $brand->id ?>"><?php echo $brand->name;?></a></li>

              <?php } ?>
</ul>
</li>
<li>
          <label for="btn-2" class="show">Products +</label>
          <a href="#">Product</a>
          <input  class="navigation__checkbox" type="checkbox" id="btn-2">
          <ul>
<!-- <li><a href="#">Web Design</a></li>
<li><a href="#">App Design</a></li> -->

<?php $categories = Category::find_all();
foreach($categories as $category){ ?>
<li>
              <label for="btn-3" class="show">More +</label>
              <a href="view_by_category.php?category=<?php echo $category->id ; ?>"><?php echo $category->name; ?> <span class="fa fa-plus"></span></a>
              <input class="navigation__checkbox" type="checkbox" id="btn-3">
              <ul>
              <?php
              $sql = "SELECT * FROM subcategory where category_id = $category->id ";
              $subcategories = Subcategory::find_by_query($sql);
foreach($subcategories as $subcategory){ ?>         
<li><a href="view_by_subcategory.php?subcategory=<?php echo $subcategory->id ; ?>"><?php echo $subcategory->name; ?></a></li>
<?php } ?>
</ul>

</li>
<?php } ?>



</ul>
</li>
<li><i class="fas  fa-globe-americas"></i><a href="contactus.php" >Feedback</a></li>
<li><i class="fas  fa-headset"></i><a href="contactus.php" >Support</a></li>
<!-- <li><a href="#" >Store Locator</a></li> -->
<li><a href="products.php" >BestSellers</a></li>
<li><a href="products.php" >Today's Deals</a></li>
</ul>
</nav>