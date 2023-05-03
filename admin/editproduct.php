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
      if(isset($_POST['submit'])){

        $product =  Product::find_by_id($_GET['id']);
        $product->name = $_POST['product_name'];
        $product->category = $_POST['product_category'];
         $product->subcategory = $_POST['product_subcategory'];
         $product->brand = $_POST['product_brand'];
         $product->description = $_POST['product_description'];
         $product->features = $_POST['product_features'];
     $product->keywords = $_POST['product_keywords'];
     $flag2=0;
     $sql = "SELECT * FROM subcategory WHERE category_id = $product->category ";
     $su = Subcategory::find_by_query($sql); 
     foreach($su as $s){
       if($s->id == $product->subcategory){
          $flag2=1;
       }
     }
     if(empty($product->name)){
      $session->message = "Product name cannot be empty"; 
    }
    else if(empty($product->keywords)){
      $session->message = "keyword cannot be empty"; 
    }
    else if(empty($product->description)){
      $session->message = "Description cannot be empty"; 
    }
    else if(empty($product->features)){
      $session->message = "Features cannot be empty"; 
    }
    else{


$ps = Product::find_all();
$select = Product::find_by_id($_GET['id']);
$flag=0;
foreach($ps as $p){
  if($p->name == $product->name){
    if(!($select->name == $p->name)){
      $flag=1;
      }
  }
}
if($flag==1){
   $session->message = "This product already exists"; 
}
else if($flag2==0){
  $session->message = "Selected subcategory doesnt come under the selected category"; 
}
else{
 
 $product->save();
 redirect("products.php");
} } }


		 ?>

		

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit product</h1>
            <h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name;
						 ?>
						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
		
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
				<?php $product = Product::find_by_id($_GET['id']) ?>
				<label for="product_title_id">Product Name : </label>
				
					 <input required type="text" id="product_title_id" name="product_name" class="form-control" value="<?php echo $product->name; ?>" ><br>
				
					 
					 <label for="product_category_id">Product Category:		 </label>
					<select name="product_category" class="form-control" id="exampleFormControlSelect1">

					
                    <?php 
                    
                  $product_category_name  =Category::find_by_id( $product->category);
          $categories = Category::find_all();
          foreach($categories as $category){
              
              if($category == $product_category_name){

                echo "<option selected value='$category->id'>$category->name</option> "; 
              }
              else{
          echo "<option value='$category->id'>$category->name</option> ";
          } }
          ?>
					
					</select><br>
			
					<label for="product_subcategory_id">Product Subcategory: </label>
					<select name="product_subcategory" class="form-control" id="product_category_id">
					
                    <?php 
                        $product_subcategory_name  =Category::find_by_id( $product->category);
          $subcategories = Subcategory::find_all();
          foreach($subcategories as $subcategory){
            if($category == $product_subcategory_name){

          echo "<option selected value='$subcategory->id'>$subcategory->name</option> ";
            }
            else{
                echo "<option value='$subcategory->id'>$subcategory->name</option> ";
            }
          }
          ?>
					
					</select><br> 

					<label for="product_brand_id">Product Brand: </label>
					<select name="product_brand" class="form-control" id="product_brand_id">
					
                    <?php 
                     $product_subcategory_name  =Category::find_by_id( $product->category);
          $brands = Brand::find_all();
          foreach($brands as $brand){
               if($category == $product_subcategory_name){
          echo "<option selected value='$brand->id'>$brand->name</option> ";
          }
          else{
            echo "<option value='$brand->id'>$brand->name</option> ";
          }
          }
          ?>
					
					</select><br> 

					<label for="product_description_id">Product Description : </label>
					<textarea name="product_description" class="form-control" id="product_description_id" rows="7"><?php echo $product->description; ?> </textarea><br>
					
					<label for="product_features_id">Product Features : </label>
					<textarea name="product_features" class="form-control" id="product_features_id" rows="15"><?php echo $product->features; ?></textarea><br>

					
					
					product Keywords
					 <input required type="text" name="product_keywords" value="<?php echo $product->keywords; ?>" class="form-control" placeholder="Enter Keywords"><br>
					 
					 
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