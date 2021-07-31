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

        $user = new User();
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
         $user->email = $_POST['email'];
         $user->password = $_POST['password'];
         $user->date = date("d/m/Y");

         $user->user_type = $_POST['user_type'];
        $user->verified = 1;
        $flag=0;

    
        
                $role = $user->user_type;
                
     
         $address = new Address();
     
        $address->address_fname =      $user->first_name;
        $address->address_lname = $user->last_name;
         $address->phone_no = $_POST['phone_no'];
         $address->house = $_POST['house'];
         $address->city = $_POST['city'];
         $address->district = $_POST['district'];
         $address->state = $_POST['state'];
         $address->pin = $_POST['pin'];
        if(!preg_match("/^[A-Za-z]+$/",$user->first_name)){
            $session->message = "Invalid First name use alphabets only";
            
        }
        else if(!preg_match("/^[A-Za-z]+$/",$user->last_name)){
            $session->message = "Invalid Last name use alphabets only";
            
        }

        else if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)){
            $session->message = "Invalid  Email Address";
     
    
    }
    
   
    
        else if(strlen($user->password)<10)
        {
            $session->message = "Please enter a password which has more than 10 characters"; 
        }
        else if(!preg_match("/^\d{10}$/",$address->phone_no)){
            $session->message = "Please enter correct phone number";
            
        }
        else if(!preg_match("/^\d{6}$/",$address->pin)){
            $session->message = "Please enter correct pin code";
            
        }
        else if(!preg_match("/^[A-Za-z ]+$/",$address->city)){
            $session->message = "Invalid City";
            
        }
        else if(!preg_match("/^[A-Za-z ]+$/",$address->district)){
            $session->message = "Invalid District";
            
        }
        else if(!preg_match("/^[A-Za-z ]+$/",$address->state)){
            $session->message = "Invalid State";
            
        }

        else{
            $us = User::find_all();
            foreach($us as $u){
                if($user->email == $u->email){
                    $flag=1;
                }
            }
            if($flag==1){
                $session->message = "Email Already exists";
            }
            else{
                
                $address->user_id = 0;
                $address->save();
                $aid = mysqli_insert_id($database->connection);
                $user->address_id = $aid;
             

             $user->password = password_hash($user->password, PASSWORD_DEFAULT);
             $user->set_file($_FILES['user_image']);
             $user->save_data_and_image();
$uid =  mysqli_insert_id($database->connection);

             $address = Address::find_by_id($aid);
             $address->user_id = $uid;
             $address->save();
            
            $userid = mysqli_insert_id($database->connection);
       
         redirect("users.php?role=$role");
            }
        }
      }
      
      ?>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add New User</h1>
      				<h6>Howdy <?php $userr = User::find_by_id($session->user_id); echo $userr->first_name; 						 ?> 						 | Your role is <?php echo $session->user_role; ?> </h6>
          </div>
		  <h4 class="bg-danger"><?php echo $session->message; ?></h4>
			<div id="admin-index-form">
		
		
			
				<form method="post" enctype="multipart/form-data">
				<div class="col-md-10 mx-5">
                <div class="form-group">
                <label for="filename_id">User Image : </label>
                <input required type="file" name="user_image" id="filename_id">
				</div>
				<label for="first_name_id">First Name : </label>
				
					 <input required type="text" id="first_name_id" name="first_name" class="form-control" value="<?php if(isset($_POST['submit'])){ echo $user->first_name; } ?>" ><br>
				
                     <label for="last_name_id">Last Name : </label>
                     
				
                <input required type="text" id="last_name_id" value="<?php if(isset($_POST['submit'])){ echo $user->last_name; } ?>" name="last_name" class="form-control" ><br>

                <label for="email_id">Email : </label>
				
					 <input required type="text" id="email_id" value="<?php if(isset($_POST['submit'])){ echo $user->email; } ?>" name="email" class="form-control" ><br>

                     <label for="password_id">Password : </label>
				
					 <input required type="password" id="password_id"  name="password" class="form-control" ><br>

                     <label for="phone_no_id">Phone Number : </label>
				
                <input required type="text" id="phone_no_id" value="<?php if(isset($_POST['submit'])){ echo $address->phone_no; } ?>" name="phone_no" class="form-control" ><br>

                <label for="pin_id">PIN code: </label>
				
                <input required type="text" id="pin_id" name="pin" value="<?php if(isset($_POST['submit'])){ echo  $address->pin; } ?>" class="form-control" ><br>

                <label for="house_id"> Flat, House no., Building, Company, Apartment: </label>
				
                <input required type="text" id="house_id" name="house" value="<?php if(isset($_POST['submit'])){ echo  $address->house; } ?>" class="form-control" ><br>
                <label for="city_id"> Town/City: </label>
				
                <input required type="text" id="city_id" name="city" class="form-control" value="<?php if(isset($_POST['submit'])){ echo  $address->city; } ?>" ><br>
                <label for="district_id"> District </label>

                <input required type="text" id="district_id" name="district" value="<?php if(isset($_POST['submit'])){ echo  $address->district; } ?>" class="form-control" ><br>
                <label for="state_id"> State: </label>
				
                <input required type="text" id="state_id" name="state" value="<?php if(isset($_POST['submit'])){ echo  $address->state; } ?>" class="form-control" ><br>
					
					</select><br> 

					<label for="user_type_id">Usertype: </label>
					<select name="user_type" class="form-control" id="user_type_id">
					<option value="staff" default >Staff</option>
                    <option value="admin" default >Admin</option>
                    <option value="customer" default >Customer</option>
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