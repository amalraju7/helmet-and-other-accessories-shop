<?php
include("includes/header.php");
?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>
<?php
include("includes/navigation.php");
?>
<?php
if(isset($_POST['drop_submit'])){
        
        $id = $_POST['variant_id'];

        $variant = Variant::find_by_id($id);
        $pc = new Purchase_Child();
        $pc->master_id = $_SESSION['master_id'];
        $pc->item_id = $id;
        $pc->quantity =  $_POST['quantity'];
        $pc->rate = $_POST['buying_price'];

        $pc->save();
        $master =  $_SESSION['master_id'];
        $pm = Purchase_master::find_by_id($master);
        $pm->total_amount =    $pm->total_amount + ( $pc->quantity * $pc->rate ) ;
        $pm->save();

        $variant->selling_price = $_POST['selling_price'];
        $variant->buying_price = $_POST['buying_price'];
    
        $variant->quantity = $variant->quantity + $_POST['quantity'];
        

        $variant->save();

        
	
      }
      ?>
<div class="container-fluid">
      <div class="row">
      <?php include("includes/sidebar.php"); ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      
          <h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name;
						 ?>
						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
		
			<div id="admin-index-form">
    <?php $s = $_GET['id'];
    $_SESSION['search'] = $s;
    ?>
			
				<form method="POST" action="purchase.php?id=<?php echo $_SESSION['search']; ?>" class="form-inline">
    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Search</button>
  </form>
				
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
                    $sql= " SELECT * FROM brand WHERE vendor_id = {$_GET['id']} ";
                    $brands = Brand::find_by_query($sql);
            
                  
                    $sql = "SELECT * FROM product WHERE ( ";
                    foreach($brands as $brand){
                    $sql .= " brand = {$brand->id} OR" ;
                    }
                    if(isset($_POST['submit'])){
                    $sql.= " brand = {$brands[0]->id} ) AND `name` LIKE '%{$_POST['search']}%' ";
                    }
                    else{
                        $sql.= " brand = {$brands[0]->id} ) AND `name` LIKE '%' ";   
                    }
                    $products = Product::find_by_query($sql);
                 
                      $sql = "SELECT * FROM variant WHERE ( ";
                      foreach($products as $product){
                      $sql .= " product_id = {$product->id} OR" ;
                      }
                    
                     @ $sql.= " product_id = {$products[0]->id}  )  ORDER BY quantity ASC ";
                  
					  $variants = Variant::find_by_query($sql);
					 foreach($variants as $variant){
					 
				 
				  ?>
			<tr>
				
					  <td><?php echo $variant->id; ?></td>
					 
					  <td><?php 
					  $product = Product::find_by_id($variant->product_id);
					  echo $product->name; ?></td>
					  <td><?php echo $variant->color; ?></td>
					  <td><?php echo $variant->size; ?></td>
					  <td><?php $images = explode(" ",$variant->images); 
						  echo "<img class='admin-photo-thumbnail user-image' src= '".$product->upload_directory . DS . $images[0] ."' >";
					   ?></td>
					  <td><?php echo $variant->selling_price; ?></td>
					  <td><?php echo $variant->buying_price; ?></td>
					  <td><?php echo $variant->quantity; ?></td>
					
					   
					  <td> 
					  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Purchase
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <form  method="post">
  <label for="quantity">Quantity</label>
  <input  type="text" name="variant_id" class="form-control" hidden value="<?php echo $variant->id ?>" >
						<input required type="number" name="quantity" class="form-control" placeholder="Quantity"  >
						<label for="quantity">Selling Price</label>
						<input type="text" name="selling_price" class="form-control" placeholder="Selling Price" value="<?php echo $variant->selling_price; ?>"  >
						<label for="quantity">Buying Price</label>
						<input type="text" name="buying_price" class="form-control" placeholder="Buying Price" value="<?php echo $variant->buying_price; ?>"  >
						<button name="drop_submit" class="btn btn-success">Purchase</button>
					</form>
  </div>
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