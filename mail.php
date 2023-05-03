<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,700;1,500&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/527093011c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="js/cardslider.js" ></script>

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" media="all" type="text/css"> 
</head>
<body class="section-mail">
<a class="login__back" href="login.php">&#10006;</a>
    <section class="mail">
        <input type="checkbox" id="cb">
        <label for="cb" class="mail__button">SEND</label>
        <label for="cb" class="mail__button mail__reset">RESEND</label>
       <p class="mail__para"> A mail will be sent to your email address for verification</p>
        <div class="mail__circle"></div>   
        <div class="mail__circle-outer"></div> 
        <svg class="mail__icon mail__mail">
            <polyline points="119,1 119,69 1,69 1,1"></polyline>
            <polyline points="119,1 60,45 1,1 119,1"></polyline>
        </svg>
        <svg class="mail__icon mail__plane">
            <polyline points="119,1 1,59 106,80 119,1"></polyline>
            <polyline points="119,1 40,67 43,105 69,73"></polyline>
        </svg>

    </section>
</body>
</html>