<?php
include("includes/header.php");
?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php
include("includes/navigation.php");
?>

<div class="container-fluid">
      <div class="row">
      <?php include("includes/sidebar.php"); ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"></h1>
            <h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name;
						 ?>
						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
		
			<div id="admin-index-form">
		
			
				<h1> ALL PRODUCTS :</h1><form method="GET"  class="form-inline">
        <select required name='field' class="browser-default custom-select">
        <option value="all">Show All</option>
  <option value="id">Id</option>
  <option value="name">Name</option>
  <option value="description">Description</option>
  <option value="features">Features</option>
  <option value="keywords">Keywords</option>
</select>
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="btnsearch" type="submit">Search</button>
  </form>
  <br>
        <a href="addproduct.php"><button class="btn btn-info">Add New</button></a>
				<hr>
				
			<table class="table table-hover">
      <thead>
        <tr>
          <th>id</th>
          <th>Name</th>
          <th>Category</th>
          <th> Subcategory</th>
          <th> Brand</th>
          <th>Status</th>
          <th>Variants</th>
          <th>Action</th>
        </tr> 
      </thead>
      <tbody>
          <?php
if(isset($_GET['btnsearch'])){
  $field = $_GET['field'];
  $search = $_GET['search'];
  if($field != 'all'){
  $sql = "SELECT * FROM product where `$field` LIKE '%$search%' ";
  $products = Product::find_by_query($sql);
  }
else{
  $products = Product::find_all();
}
  }
else{
          $products = Product::find_all();
          }
          foreach($products as $product){
         ?>
        <tr data-toggle="collapse" id="table<?php echo $product->id; ?>" data-target=".table<?php echo $product->id; ?>">
          <td><?php echo $product->id; ?></td>
   
          <td><?php echo $product->name;  ?></td>
          <td><?php $category = Category::find_by_id($product->category); echo $category->name; ?></td>
          <td><?php $subcategory = Subcategory::find_by_id($product->subcategory); echo $subcategory->name; ?></td>
				  <td><?php $brand = Brand::find_by_id($product->brand); echo $brand->name; ?></td>
          <td><?php echo $product->status; ?></td>
          <td><?php $count =0;
           $sql = "SELECT * FROM variant WHERE product_id = '{$product->id}' ";
           $vs = Variant::find_by_query($sql);
           foreach($vs as $v){
            $count++;
           }
           echo $count;
          ?></td>
          <td><a href="editproduct.php?id=<?php echo $product->id; ?>"><button class="btn btn-info">Edit</button></a> 
          <?php if($product->status == 0){ ?>
          <a href="activate.php?id=<?php echo $product->id; ?>"><button class="btn btn-primary">Activate</button></a>
          <?php } else { ?>
            <a href="activate.php?id=<?php echo $product->id; ?>"><button class="btn btn-primary">Deactivate</button></a>
          <?php } ?>
          <?php if($session->user_role != "staff"){ ?>

<a onclick="return confirm('Are You sure');" href="deleteproduct.php?id=<?php echo $product->id; ?>">
            <button class="btn btn-danger">Delete</button></a>
          <?php } ?>

					  <a href="addvariant.php?id=<?php echo $product->id; ?>"><button class="btn btn-success">Add Variants</button></a>
            <a href="productdetails.php?id=<?php echo $product->id; ?>"><button class="btn btn-success">Details</button></a>
            <button class="btn btn-warning btn-md">View Variants</button></td>
        </tr>

        <tr class="collapse table<?php echo $product->id; ?>">
          <td colspan="999">
            <div>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>id</th>
        
                    <th>Color</th>
                    <th>Size</th>
                                <th>Images</th>
                    <th>Selling_price</th>
                    <th>Buying_price</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                      $sql = "SELECT * FROM variant WHERE product_id = '{$product->id}' ";
                      $variants = Variant::find_by_query($sql);
                      foreach($variants as $variant){
                          
                    
                    ?>
                  <tr>
                    <td><?php echo $variant->id; ?></td>
                    <td><input type="color" value='<?php echo $variant->color; ?>'></td>
                    <td><?php echo $variant->size; ?></td>
                    <td><?php  foreach(explode(" ",$variant->images) as $image){
						  echo "<img class='admin-photo-thumbnail user-image' src= '".$product->upload_directory . DS . $image ."' >";
					  } ?></td>
               	  <td><?php echo $variant->selling_price; ?></td>
                   <td><?php echo $variant->buying_price; ?></td>
                   <td><?php echo $variant->quantity; ?></td>
                  </tr>
                      <?php } ?>
                 
                </tbody>
              </table>
            </div>
          </td>
        </tr>
         <?php } ?>
        
      </tbody>
    </table>
				
	
        
          </div>
        </main>
      </div>
    </div>
	
    <?php
include("includes/footer.php");
?>