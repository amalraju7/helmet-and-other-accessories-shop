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
		
			
				<h1>Details :</h1>
    
				<hr>
				
			<table class="table table-hover">
      <thead>
        <tr>
          <th>Description</th>
          <th>Features</th>
          <th>Keywords</th>
    
        </tr> 
      </thead>
      <tbody>
          <?php
      
          $product = Product::find_by_id($_GET['id']);
          
         
         ?>
        <tr   >
         
   
          <td><?php echo $product->description;  ?></td>
          <td><?php echo $product->features;  ?></td>
          <td><?php echo $product->keywords;  ?></td>
        </tr>
         
        
      </tbody>
    </table>
				
	
        
          </div>
        </main>
      </div>
    </div>
	
    <?php
include("includes/footer.php");
?>