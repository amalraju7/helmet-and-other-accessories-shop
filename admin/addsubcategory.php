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

        $subcategory = new Subcategory();
        $subcategory->name = $_POST['subcategory_name'];
        $subcategory->category_id = $_POST['category_id'];
        $subcategory->description = $_POST['subcategory_description'];
        $flag = 0;
        $scs = Subcategory::find_all();
        foreach($scs as $sc)
      {
   
        if($sc->name == $subcategory->name){
      
          $flag =1;
        }
      }
      if($flag==1){
        $session->message = " This Subcategory already exists";
      }
      else if(empty($subcategory->name)){
        $session->message = " Subcategory name cannot be empty";
      }
      else if(empty($subcategory->description)){
        $session->message = " Description cannot be empty";
      }
      else{
        $subcategory->save();
        redirect("subcategories.php");
       }
  }
      
		 
 
    ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" >
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add New Subcategory</h1>
            	<h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name; 						 ?> 						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
		
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
				
				<label for="subcategory_title_id">Subcategory Name : </label>
				
					 <input type="text" value="<?php if(isset($_POST['description'])){ echo $subcategory->name; } ?>" id="subcategory_title_id" name="subcategory_name" class="form-control" ><br>
				
					 
					<label for="product_subcategory_id">Category: </label>
       
					<select name="category_id" class="form-control" id="product_subcategory_id">

          <?php 
          $categories = Category::find_all();
          foreach($categories as $category){
          echo "<option value='$category->id'>$category->name</option> ";
          }
          ?>
					
					</select><br> 
					

					<label for="subcategory_description_id">Subcategory Description : </label>
					<textarea name="subcategory_description" class="form-control" id="subcategory_description_id" rows="7"><?php if(isset($_POST['description'])){  echo $subcategory->description; } ?></textarea><br>
					

					
					
					
					 
					 
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