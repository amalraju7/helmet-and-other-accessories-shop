<?php
include("includes/header.php");
?>

<?php
include("includes/navigation.php");
?>



<div class="container-fluid">
      <div class="row">
      <?php include("includes/sidebar.php"); ?>
      <?php 
      if(isset($_POST['submit'])){
      print_r($_FILES['files']);
 
       


    }
    
    ?>


      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add Images</h1>
            <h6>Howdy | Your role is</h6>
          </div>
		
			<div id="admin-index-form">
		
            <form action="addimages.php" method="POST"
            enctype="multipart/form-data"> 

          
        <p> 
            Select files to upload:  
          
            <input type="file" name="files[]" multiple> 
              
            <br><br> 
              
            <input type="submit" name="submit" value="Upload" > 
        </p> 
    </form> 
				
				
			</div>
        
          </div>
        </main>
      </div>
    </div>

    <script src="./path/to/dropzone.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ey5ln3e6qq2sq6u5ka28g3yxtbiyj11zs8l6qyfegao3c0su"></script>

<script>tinymce.init({ selector:'textarea' });</script>
    <?php
include("includes/footer.php");
?>