<?php
include("includes/header.php");
?>

<?php
include("includes/navigation.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("../login.php");} ?>


<div class="container-fluid">
      <div class="row">
      <?php include("includes/sidebar.php"); ?>
      <?php 
      if(isset($_POST['submit'])){

        $brand =  Brand::find_by_id($_GET['id']);
        $brand->name = $_POST['brand_name'];
        $brand->vendor_id = $_POST['vendor_id'];
        $brand->description = $_POST['brand_description'];
     
      
        $flag=0;
        $bs = Brand::find_all();
        $select = Brand::find_by_id($_GET['id']);
        foreach($bs as $b){
          if($b->name == $brand->name ){
            if(!($select->name == $b->name)){
            $flag=1;
            }
          }
        }
        if($flag == 1){
          $session->message = "Brand already exists";
        }
      
		 
	      
        else if(empty($brand->description)){
          $session->message = "Please enter description";
        }
  
        else{
		 
     $brand->save();
     redirect("brands.php");
    }
    }
    
    ?>


      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit brand</h1>
            <h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name; 						 ?> 		
            				 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
		<?php  $brand =  Brand::find_by_id($_GET['id']); ?>
			<div id="admin-index-form">
		
		
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
				
				<label for="brand_title_id">Brand Name : </label>
				
					 <input required type="text" id="brand_title_id" value="<?php echo $brand->name ?>" name="brand_name" class="form-control" ><br>
           <label for="product_subcategory_id">Vendor: </label>
           <select name="vendor_id" class="form-control" id="product_subcategory_id">
           <?php 
           $selected_vendor = Vendor::find_by_id($brand->vendor_id);
          $vendors = Vendor::find_all();
          foreach($vendors as $vendor){
              if($vendor == $selected_vendor){
          echo "<option selected value='$vendor->id'>$vendor->name</option> ";
        }
        else{
            echo "<option value='$vendor->id'>$vendor->name</option> ";
          }
          }
          ?>
					</select><br>

					<label for="brand_description_id">Brand Description : </label>
					<textarea name="brand_description" class="form-control" id="brand_description_id" rows="7"><?php echo $brand->description ?></textarea><br>
					
					
					
					
					 
					 
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