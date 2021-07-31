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

       
    
         $address = Address::find_by_id($_GET['id']);
   
       
         
        $address->address_fname =     $_POST['first_name'];
        $address->address_lname = $_POST['last_name'];
         $address->phone_no = $_POST['phone_no'];
         $address->house = $_POST['house'];
         $address->city = $_POST['city'];
         $address->district = $_POST['district'];
         $address->state = $_POST['state'];
         $address->pin = $_POST['pin'];

     
         if(!preg_match("/^[A-Za-z]+$/",$address->address_fname)){
            $session->message = "Invalid First name use alphabets only";
            
        }
        else if(!preg_match("/^[A-Za-z]+$/",$address->address_lname)){
            $session->message = "Invalid Last name use alphabets only";
            
        }

   
       
        else if(!preg_match("/^\d{10}$/",$address->phone_no)){
            $session->message = "Please enter correct phone number";
            
        }
        else if(!preg_match("/^\d{6}$/",$address->pin)){
            $session->message = "Please enter correct pin code";
            
        }
        else if(!preg_match("/^[A-Za-z .]+$/",$address->city)){
            $session->message = "Invalid City";
            
        }
        else if(!preg_match("/^[A-Za-z .]+$/",$address->district)){
            $session->message = "Invalid District";
            
        }
        else if(!preg_match("/^[A-Za-z .]+$/",$address->state)){
            $session->message = "Invalid State";
            
        }
       

        else{
           
   
          $id = $address->user_id;

         $address->save();
         redirect("viewaddress.php?id=$id");
     
        }
    

      }
      
      ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Address</h1>
      				<h6>Howdy <?php $user = User::find_by_id($session->user_id); echo $user->first_name; 						 ?> 						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
          <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
                <?php 
                $id = $_GET['id'];
               

                $address = Address::find_by_id($id);

           

                ?>
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
             
				<label for="first_name_id">First Name : </label>
				
					 <input required type="text" id="first_name_id" value="<?php echo $address->address_fname; ?>" name="first_name" class="form-control" ><br>
				
                     <label for="last_name_id">Last Name : </label>
                     
				
                <input required type="text" id="last_name_id"  value="<?php echo $address->address_lname; ?>" name="last_name" class="form-control" ><br>

       
				
			
				
					 

                     <label for="phone_no_id">Phone Number : </label>
				
                <input required type="text" id="phone_no_id" value="<?php echo $address->phone_no; ?>" name="phone_no" class="form-control" ><br>

                <label for="pin_id">PIN code: </label>
				
                <input required type="text" id="pin_id" name="pin"  value="<?php echo empty($address->id) ? "User not entered" :  $address->pin; ?>" class="form-control" ><br>

                <label for="house_id"> Flat, House no., Building, Company, Apartment: </label>
				
                <input required type="text" id="house_id" value="<?php echo empty($address->id) ? "User not entered" :  $address->house; ?>" name="house" class="form-control" ><br>
                <label for="city_id"> Town/City: </label>
				
                <input required type="text" id="city_id" value="<?php echo empty($address->id) ? "User not entered" :  $address->city; ?>" name="city" class="form-control" ><br>
                <label for="district_id"> District </label>

                <input required type="text" id="district_id" value="<?php echo empty($address->id) ? "User not entered" :  $address->district; ?>" name="district" class="form-control" ><br>
                <label for="state_id"> State: </label>
				
                <input required type="text" id="state_id" name="state" class="form-control" value="<?php echo empty($address->id) ? "User not entered" :  $address->state; ?>" ><br>
					
					</select><br> 

					

                    


				
				
					 
					 
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