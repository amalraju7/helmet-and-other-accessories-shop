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
          
        $category = Category::find_by_id($_GET['id']);
        $category->name = $_POST['category_name'];
        $category->description = $_POST['category_description'];
        $flag = 0;
        $cs = Category::find_all();
        $select = Category::find_by_id($_GET['id']);
        foreach($cs as $c)
      {
   
        if($c->name == $category->name){
      
          if(!($select->name == $c->name)){
            $flag=1;
            }
        }
      }
      if($flag==1){
        $session->message = " This Category already exists";
      }
      else if(empty($category->name)){
        $session->message = " Category name cannot be empty";
      }
      else if(empty($category->description)){
        $session->message = " Description cannot be empty";
      }
      else{
     $category->save();
     redirect("categories.php");
	  }
  }
	  

		 ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Category</h1>
      				<h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name; 						 ?> 						 | Your role is <?php echo $session->user_role; ?> </h6>						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
		
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
                    <?php 
                    $category = Category::find_by_id($_GET['id']);
                    ?>
				
				<label for="category_title_id">Category Name : </label>
				
					 <input required type="text" id="category_title_id" name="category_name" value="<?php  echo $category->name;  ?>" class="form-control" ><br>
				
					 
					

					<label for="category_description_id">Category Description : </label>
					<textarea name="category_description" class="form-control" id="category_description_id" rows="7"><?php  echo $category->description;  ?></textarea><br>
					
				

					
					
					
					 
					 
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