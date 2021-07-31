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
		
			
				<h1>ALL VARIANTS :</h1>
				
				<hr>
				
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col"> Id</th>
		
					  <th scope="col">Product</th>
					  <th scope="col">Color</th>
					  <th scope="col">Size</th>
					  <th scope="col">Image</th>
					  <th scope="col">Selling Price</th>
					  <th scope="col">Buying Price</th>
					  <th scope="col"> Quantity</th>
					  <th scope="col">Action</th>
				
					</tr>
				  </thead>
				  
		
			<?php 
				
					 $variants = Variant::find_all();
					 foreach($variants as $variant){
					 
				 
				  ?>
			<tr>
				
					  <td><?php echo $variant->id; ?></td>
					 
					  <td><?php 
					  $product = Product::find_by_id($variant->product_id);
					  echo $product->name; ?></td>
				  <td><input type="color" value='<?php echo $variant->color; ?>'></td>
					  <td><?php echo $variant->size; ?></td>
					  <td><?php  foreach(explode(" ",$variant->images) as $image){
						  echo "<img class='admin-photo-thumbnail user-image' src= '".$product->upload_directory . DS . $image ."' >";
					  } ?></td>
					  <td><?php echo $variant->selling_price; ?></td>
					  <td><?php echo $variant->buying_price; ?></td>
					  <td><?php echo $variant->quantity; ?></td>
					
					   
					  <td><a href="editvariant.php?id=<?php echo $variant->product_id   ."&values=".  $variant->size .",".  ltrim($variant->color,$variant->color[0]) .",".$variant->id ?>"><button class="btn btn-info">Edit</button></a> 
					

					  <?php if($session->user_role != "staff"){ ?>

					   <a onclick="return confirm('Are You sure');" href="deletevariant.php?id=<?php echo $variant->id; ?>"><button class="btn btn-danger">Delete</button></a></td>
					  <?php } ?>
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