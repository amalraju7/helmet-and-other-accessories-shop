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

    <?php 
    
    if(isset($_GET['values'])){
     
      $values = explode(',',$_GET['values']);
      $csize = $values[0];
      
      $ccolor = "#".$values[1];
      $id = $values[2];
      
    


      if(isset($_POST['submit'])){



        $variant = Variant::find_by_id($id);
     
        $variant->product_id = $_GET['id'];
        $variant->color = $_POST['color'];
        $variant->selling_price = $_POST['selling_price'];
        $variant->buying_price = $_POST['buying_price'];
        $variant->size = $csize;
        $variant->quantity =  $_POST['quantity'];
        $images = $variant->images;
      
        unset($variant->images);
        $variant->save_multiple_images($_FILES['files']);
 
        if($_FILES['files']['size'][0] > 1){
         
          unset($variant->images);
          $variant->save_multiple_images($_FILES['files']);
        
         
        }
        else{
          $variant->images = $images;
      
        }

        echo $variant->save();
        redirect("variants.php");
        
	
      }
    }

		 ?>

		

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Purchase</h1>
            <!-- <h6>Howdy  | Your role is</h6> -->
          </div>
		
			<div id="admin-index-form">
           <?php $variant = Variant::find_by_id($id); 
            $product = Product::find_by_id($variant->product_id);
            ?>
		
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
        <label for="product_title_id">Product : </label>
				
        <input required type="text" id="product_title_id" name="product"  class="form-control" value="<?php echo $product->name ?>" disabled ><br>
      
			
           <label for="product_title_id">Color : </label>
				
        
        
        <input required type="color" id="product_title_id" name="color"  value="<?php echo $ccolor; ?>" class="form-control" ><br>
        
        <label for="product_title_id">Size : </label>

        <input required type="text" id="product_title_id" name="size"  value="<?php echo $variant->size; ?>" class="form-control" disabled ><br>
				
        <label for="product_title_id" >Upload Images : </label>
				
        <input  type="file" id="product_title_id" name="files[]" class="form-control"  multiple ><br>
     
        <label for="product_title_id">Selling Price : </label>
				
        <input required type="text" id="product_title_id" value="<?php echo $variant->selling_price; ?>" name="selling_price" class="form-control" ><br>

        <label for="product_title_id">Buying Price : </label>
				
                <input required type="text" id="product_title_id" value="<?php echo $variant->buying_price; ?>" name="buying_price" class="form-control" ><br>

  
        <label for="product_title_id">Quantity : </label>
				
        <input required type="text" id="product_title_id" name="quantity" value="<?php echo $variant->quantity; ?>" class="form-control" ><br>

      
    
					 
					 <button name="submit" type="submit" class="btn btn-primary">Submit</button>
				</div>
				</form>
				
				
				
			</div>
        
          </div>
        </main>
      </div>
    </div>


    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ey5ln3e6qq2sq6u5ka28g3yxtbiyj11zs8l6qyfegao3c0su"></script>

<script>tinymce.init({ selector:'textarea' });</script>
    <?php
include("includes/footer.php");
?>