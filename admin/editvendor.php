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
        
           
                    $vendor = Vendor::find_by_id($_GET['id']);
        $vendor->name = $_POST['vendor_name'];
        $vendor->email = $_POST['email'];
        $vendor->phone_no = $_POST['phone_no'];
        $vendor->house = $_POST['house'];
        $vendor->city = $_POST['city'];
        $vendor->district = $_POST['district'];
        $vendor->state = $_POST['state'];
        $vendor->pin = $_POST['pin'];
        $flag1=0;
        $flag2=0;
  if(!filter_var($vendor->email, FILTER_VALIDATE_EMAIL))  
  {
    $session->message = "Invalid  Email Address";
  }
  else if(!preg_match("/^\d{10}$/",$vendor->phone_no)){
    $session->message = "Please enter correct phone number";
    
}     else if(!preg_match("/^\d{6}$/",$vendor->pin)){
  $session->message = "Please enter correct pin code";
  
}     else if(!preg_match("/^[A-Za-z]+$/",$vendor->city)){
  $session->message = "Invalid City";
  
} else if(!preg_match("/^[A-Za-z]+$/",$vendor->district)){
  $session->message = "Invalid District";
  
}    else if(!preg_match("/^[A-Za-z]+$/",$vendor->state)){
  $session->message = "Invalid State";
  
}
else{ 
   $vs = Vendor::find_all();
   $select = Vendor::find_by_id($_GET['id']);

   foreach($vs as $v){
     if($v->name == $vendor->name){
         if(!($v->name == $select->name )){
      $flag1=1;
         }
     }
     if($v->email == $vendor->email){
        if(!($v->email == $select->email)){
       $flag2=1;
     } }
   }
   if($flag1==1){
     $session->message = "This name already exists ";
   }
   else if($flag2==1){
     $session->message ="This email already exisis ";
   }
   else{
     $vendor->save();
     redirect("vendors.php");
   }
    } }
    
    ?>


      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Vendor</h1>
            <h6>Howdy | Your role is</h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
		<?php $vendor = Vendor::find_by_id($_GET['id']); ?> 
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
				
				<label for="vendor_title_id">Vendor Name : </label>
				
					 <input required type="text" id="vendor_title_id" name="vendor_name" value="<?php  echo  $vendor->name;  ?>" class="form-control" ><br>
				
					 
           <label for="email_id">Email : </label>
				
					 <input required type="text" id="email_id" value="<?php 	echo $vendor->email;  ?>" name="email" class="form-control" ><br>

                     

                     <label for="phone_no_id">Phone Number : </label>
				
                <input required type="text" id="phone_no_id" value="<?php 	echo $vendor->phone_no; ?>" name="phone_no" class="form-control" ><br>

               

                <label for="house_id"> Flat, House no., Building, Company, Apartment: </label>
				
                <input required type="text" id="house_id" name="house" value="<?php 	echo  $vendor->house;  ?>" class="form-control" ><br>
                <label for="city_id"> Town/City: </label>
				
                <input required type="text" id="city_id" name="city" class="form-control" value="<?php 	echo  $vendor->city;  ?>" ><br>
                <label for="district_id"> District </label>

                <input required type="text" id="district_id" name="district" value="<?php 	echo  $vendor->district;  ?>" class="form-control" ><br>
                <label for="state_id"> State: </label>
				
                <input required type="text" id="state_id" name="state" value="<?php 	echo  $vendor->state;  ?>" class="form-control" ><br>
					
		
					
          <label for="pin_id">PIN code: </label>
				
                <input required type="text" id="pin_id" name="pin" value="<?php 	echo  $vendor->pin;  ?>" class="form-control" ><br>
					
					
					

					
					
					
					 
					 
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