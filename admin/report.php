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
            <h1 class="h2">Report Generation</h1>
            <h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name; 						 ?> 		
            				 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
		<?php if($_GET['report'] == "sales"){ ?>
			
                <form method="post" action="salereport.php" enctype="multipart/form-data">
    <?php } else if($_GET['report'] == "customero"){ ?>   
                  <form method="post" action="customeroreport.php" enctype="multipart/form-data">
                  <?php } else if($_GET['report'] == "customer"){ ?>   
                  <form method="post" action="customerreport.php" enctype="multipart/form-data">
                  <?php } else if($_GET['report'] == "vendor"){ ?>   
                  <form method="post" action="vendorreport.php" enctype="multipart/form-data">
                  <?php } else if($_GET['report'] == "staff"){ ?>   
                  <form method="post" action="staffreport.php" enctype="multipart/form-data">
                  <?php } else if($_GET['report'] == "order"){ ?>   
                  <form method="post" action="orderreport.php" enctype="multipart/form-data">
        <?php } else{ ?>
            <form method="post" action="purchasereport.php" enctype="multipart/form-data">
        <?php } ?>
				<div class="col-md-3 mx-5">
				
				<label for="brand_title_id">From : </label>
				
					 <input required type="date" id="brand_title_id" name="from" value="<?php if(isset($_POST['submit'])){ echo  $brand->name; } ?>" class="form-control" >
</div> <div class="col-md-3 mx-5">
				<label for="brand_title_id">To : </label>
				
					 <input required type="date" id="brand_title_id" name="to" value="<?php if(isset($_POST['submit'])){ echo  $brand->name; } ?>" class="form-control" >
					 
					 <button name="submit" type="submit" class="btn btn-primary my-3">Submit</button>
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