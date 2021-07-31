<html>
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Hello</title>
                <link rel="stylesheet" href="css/contactus.css">
				<?php 
				if(isset($_POST['submit'])){
				$to      = "mactanse@gmail.com";
				$subject = "Complaint";
				$message = "Complaint from ".$_POST['name']." Email is ".$_POST['email']." Complaint body ".$_POST['body']." ";
				mail($to, $subject, $message,'From: mactanse@gmail.com');
				}
				?>
</head>
                <body>
				<a class="login__back" href="index.php">&#10006;</a>
								<div class="contact-form-container">
								<div class="contact-us">
									<div class="contact-header">
										<h1>
											&#9135;&#9135;&#9135;&#9135;&nbsp;&nbsp;CONTACT US
										</h1>
									</div>
									<div class="social-bar">
										<ul>
											<li>
												<i class="fab fa-facebook-f"></i>
											</li>
											<li>
												<i class="fab fa-twitter"></i>
											</li>
											<li>
												<i class="fab fa-instagram"></i>
											</li>
											<li>
												<i class="fab fa-dribbble"></i>
											</li>
										</ul>
									</div>
								</div>
								<div class="header">
									<h1>
										Let's Get Started
									</h1>
									<h2>
										Contact us to solve your problem! 
									</h2>
								</div>
								<div class="address">
									<i class="fas fa-map-marker-alt"></i>
									<h3>
									 XXX/289-c Galtex building
									</h3>
									<h3>
									Kalamassery, Ernakulam
									</h3>
									<h3> Kerala ,682304 </h3>
								</div>
								<div class="phone">
									<i class="fas fa-phone-alt"></i>
									<h3>
									 7907071717
									</h3>
								</div>
								<div class="email">
									<i class="fas fa-envelope"></i>
									<h3>
										mactanse@gmail.com
									</h3>
								</div>
								<div class="contact-form">
									<form method="post">
										<input placeholder="Name" type="text" name="name" /><input placeholder="Email" type="email" name="email" /><textarea name="body" placeholder="Tell us about your problem..." rows="4"></textarea><button type="submit" name="submit">SEND </button>
									</form>
								</div>
							</div>
</body>
</html>
    
           
