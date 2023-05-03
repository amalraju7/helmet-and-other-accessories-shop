<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\helmet-and-other-accessories-shop-main\vendor\autoload.php';

class User extends Db_object{
    public $id;
    public $filename;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
 
    public $address_id;
    
    public $user_type;
    public $verified;
    public $date;
    public $card_id;
    public $status;


    public static $db_table = "users";
    public static $db_table_fields = array('filename','first_name','last_name','email','password','address_id','user_type','verified','date','card_id','status');
    
    public static function verify_user($email,$password)
    {
        global $database;
        $email = $database->escape_string($email);
        $password = $database->escape_string($password);
      
        $sql = "SELECT * FROM ".self::$db_table. " WHERE ";
        $sql .= "email = '{$email}'  LIMIT 1 ";
        if($sql){
        $the_result_array = self::find_by_query($sql);
        $the_result_array = array_shift($the_result_array);
        if(mysqli_affected_rows($database->connection)!=0){
         return password_verify($password , $the_result_array->password) ? $the_result_array : false;
        }
        }
        else{
            return false;
        }
    
        
        
       
    }

    public function email_verification(){
        global $database;
        $vkey = md5(time().$this->email);
        $date = date("d/m/Y");
        $sql = "UPDATE ".self::$db_table." SET `vkey` = '{$vkey}' , `date` = '{$date}' WHERE ";
        $sql .= "email = '".$this->email ."' ";
        $database->query($sql);
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'c1567b9e78a31a';                     //SMTP username
        $mail->Password   = 'b20228c201bdb7';                               //SMTP password
              //Enable implicit TLS encryption
        $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('mactanse@gmail.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress($this->email);               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');

    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
       
  

    
     
        $mail->Subject = "Email Verification"; 
        $mail->Body  = " 
        <html lang='en' dir='ltr'>
          <head>
            <title></title>
            <!--[if !mso]><!-- -->
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <!--<![endif]-->
          <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
          <style type='text/css'>
            #outlook a { padding: 0; }
            .ReadMsgBody { width: 100%; }
            .ExternalClass { width: 100%; }
            .ExternalClass * { line-height:100%; }
            body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
            table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
            img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
            p { display: block; margin: 13px 0; }
          </style>
          <!--[if !mso]><!-->
          <style type='text/css'>
            @media only screen and (max-width:480px) {
              @-ms-viewport { width:320px; }
              @viewport { width:320px; }
            }
          </style>
          <!--<![endif]-->
          <!--[if mso]>
          <xml>
            <o:OfficeDocumentSettings>
              <o:AllowPNG/>
              <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
          </xml>
          <![endif]-->
          <!--[if lte mso 11]>
          <style type='text/css'>
            .outlook-group-fix {
              width:100% !important;
            }
          </style>
          <![endif]-->
          
          <!--[if !mso]><!-->
              <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
              <style type='text/css'>
          
                  @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);
          
              </style>
            <!--<![endif]--><style type='text/css'>
            @media only screen and (min-width:480px) {
              .mj-column-per-100, * [aria-labelledby='mj-column-per-100'] { width:100%!important; }
            }
          </style>
          </head>
          <body style='background: #F9F9F9;'>
            <div style='background-color:#F9F9F9;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]-->
            <style type='text/css'>
              html, body, * {
                -webkit-text-size-adjust: none;
                text-size-adjust: none;
              }
              a {
                color:#1EB0F4;
                text-decoration:none;
              }
              a:hover {
                text-decoration:underline;
              }
            </style>
          <div style='margin:0px auto;max-width:640px;background:transparent;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:transparent;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:40px 0px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:0px;' align='center'><table role='presentation' cellpadding='0' cellspacing='0' style='border-collapse:collapse;border-spacing:0px;' align='center' border='0'><tbody><tr><td style='width:138px;'><a href='https://discordapp.com/' target='_blank'>
                </a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='max-width:640px;margin:0 auto;box-shadow:0px 1px 5px rgba(0,0,0,0.1);border-radius:4px;overflow:hidden'><div style='margin:0px auto;max-width:640px;background:#7289DA url(https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png) top center / cover no-repeat;'><!--[if mso | IE]>
                <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='width:640px;'>
                  <v:fill origin='0.5, 0' position='0.5,0' type='tile' src='https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png' />
                  <v:textbox style='mso-fit-shape-to-text:true' inset='0,0,0,0'>
                <![endif]--><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:#7289DA url(https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png) top center / cover no-repeat;' align='center' border='0' background='https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:57px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:undefined;width:640px;'>
                <![endif]--><div style='cursor:auto;color:white;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:36px;font-weight:600;line-height:36px;text-align:center;'>Welcome to Mactanse!</div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table><!--[if mso | IE]>
                  </v:textbox>
                </v:rect>
                <![endif]--></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='margin:0px auto;max-width:640px;background:#ffffff;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:#ffffff;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:40px 70px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:0px 0px 20px;' align='left'><div style='cursor:auto;color:#737F8D;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:16px;line-height:24px;text-align:left;'>
                      <p><img src='https://cdn.discordapp.com/email_assets/127c95bbea39cd4bc1ad87d1500ae27d.png' alt='Party Wumpus' title='None' width='500' style='height: auto;'></p>
          
            <h2 style='font-family: Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-weight: 500;font-size: 20px;color: #4F545C;letter-spacing: 0.27px;'>
            Hey  $this->first_name $this->last_name  </h2>
          <p>Wowwee! Thanks for registering an account with Mactanse! You're the coolest person in all the land (and I've met a lot of really cool people).</p>
          <p>Before we get started, we'll need to verify your email.</p>
          
                    </div></td></tr><tr><td style='word-break:break-word;font-size:0px;padding:10px 25px;' align='center'><table role='presentation' cellpadding='0' cellspacing='0' style='border-collapse:separate;' align='center' border='0'><tbody><tr><td style='border:none;border-radius:3px;color:white;cursor:auto;padding:15px 19px;' align='center' valign='middle' bgcolor='#7289DA'>
                    <a href='http://localhost/projects/mini/verification.php?vkey=$vkey' style='text-decoration:none;line-height:100%;background:#7289DA;color:white;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:15px;font-weight:normal;text-transform:none;margin:0px;'>
                      Verify Email
                    </a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--></div><div style='margin:0px auto;max-width:640px;background:transparent;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:transparent;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:0px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;'><div style='font-size:1px;line-height:12px;'>&nbsp;</div></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='margin:0 auto;max-width:640px;background:#ffffff;box-shadow:0px 1px 5px rgba(0,0,0,0.1);border-radius:4px;overflow:hidden;'><table cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:#ffffff;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;font-size:0px;padding:0px;'><!--[if mso | IE]>
                <table border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:30px 70px 0px 70px;' align='center'><div style='cursor:auto;color:#43B581;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:18px;font-weight:bold;line-height:16px;text-align:center;'>FUN FACT #16</div></td></tr><tr><td style='word-break:break-word;font-size:0px;padding:14px 70px 30px 70px;' align='center'><div style='cursor:auto;color:#737F8D;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:16px;line-height:22px;text-align:center;'>
                In Hearthstone, using the Hunter card Animal Companion against Kel'Thuzad will summon his cat Mr. Bigglesworth rather than the usual beasts.
              </div></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='margin:0px auto;max-width:640px;background:transparent;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:transparent;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:0px;' align='center'><div style='cursor:auto;color:#99AAB5;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:12px;line-height:24px;text-align:center;'>
                Sent by Mactanse • <a href='http://localhost/projects/mini/index.php' style='color:#1EB0F4;text-decoration:none;' target='_blank'>check our blog</a> • <a href='http://localhost/projects/mini/index.php' style='color:#1EB0F4;text-decoration:none;' target='_blank'>@Mactanseapp</a>
              </div></td></tr><tr><td style='word-break:break-word;font-size:0px;padding:0px;' align='center'><div style='cursor:auto;color:#99AAB5;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:12px;line-height:24px;text-align:center;'>
        
              </div></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></div>
          
          </body>
          </body>
        </html>
"        
     ;
     $mail->send();


                  
    }

  public static  function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); 
    }

    
    public function forgot_password(){
        $mail = new PHPMailer(true);
        global $database;
        $password = User::randomPassword();
      
        $password_hash = password_hash($password,PASSWORD_DEFAULT);
   

        $sql = "UPDATE ".self::$db_table." SET `password` = '{$password_hash}'  WHERE ";
        $sql .= "email = '".$this->email ."' ";
        $database->query($sql);
       
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'c1567b9e78a31a';                     //SMTP username
          $mail->Password   = 'b20228c201bdb7';                               //SMTP password
                //Enable implicit TLS encryption
          $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      
          //Recipients
          $mail->setFrom('mactanse@gmail.com', 'Mailer');
          $mail->addAddress($this->email, 'Joe User');     //Add a recipient
          $mail->addAddress($this->email);               //Name is optional
          $mail->addReplyTo('info@example.com', 'Information');
          $mail->addCC('cc@example.com');
          $mail->addBCC('bcc@example.com');
      
          
          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = "Forgot Password"; 
          $mail->Body    = "<html lang='en' dir='ltr'>
          <head>
            <title></title>
            <!--[if !mso]><!-- -->
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <!--<![endif]-->
          <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
          <style type='text/css'>
            #outlook a { padding: 0; }
            .ReadMsgBody { width: 100%; }
            .ExternalClass { width: 100%; }
            .ExternalClass * { line-height:100%; }
            body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
            table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
            img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
            p { display: block; margin: 13px 0; }
          </style>
          <!--[if !mso]><!-->
          <style type='text/css'>
            @media only screen and (max-width:480px) {
              @-ms-viewport { width:320px; }
              @viewport { width:320px; }
            }
          </style>
          <!--<![endif]-->
          <!--[if mso]>
          <xml>
            <o:OfficeDocumentSettings>
              <o:AllowPNG/>
              <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
          </xml>
          <![endif]-->
          <!--[if lte mso 11]>
          <style type='text/css'>
            .outlook-group-fix {
              width:100% !important;
            }
          </style>
          <![endif]-->
          
          <!--[if !mso]><!-->
              <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
              <style type='text/css'>
          
                  @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);
          
              </style>
            <!--<![endif]--><style type='text/css'>
            @media only screen and (min-width:480px) {
              .mj-column-per-100, * [aria-labelledby='mj-column-per-100'] { width:100%!important; }
            }
          </style>
          </head>
          <body style='background: #F9F9F9;'>
            <div style='background-color:#F9F9F9;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]-->
            <style type='text/css'>
              html, body, * {
                -webkit-text-size-adjust: none;
                text-size-adjust: none;
              }
              a {
                color:#1EB0F4;
                text-decoration:none;
              }
              a:hover {
                text-decoration:underline;
              }
            </style>
          <div style='margin:0px auto;max-width:640px;background:transparent;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:transparent;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:40px 0px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:0px;' align='center'><table role='presentation' cellpadding='0' cellspacing='0' style='border-collapse:collapse;border-spacing:0px;' align='center' border='0'><tbody><tr><td style='width:138px;'><a href='https://discordapp.com/' target='_blank'>
                </a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='max-width:640px;margin:0 auto;box-shadow:0px 1px 5px rgba(0,0,0,0.1);border-radius:4px;overflow:hidden'><div style='margin:0px auto;max-width:640px;background:#7289DA url(https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png) top center / cover no-repeat;'><!--[if mso | IE]>
                <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='width:640px;'>
                  <v:fill origin='0.5, 0' position='0.5,0' type='tile' src='https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png' />
                  <v:textbox style='mso-fit-shape-to-text:true' inset='0,0,0,0'>
                <![endif]--><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:#7289DA url(https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png) top center / cover no-repeat;' align='center' border='0' background='https://cdn.discordapp.com/email_assets/f0a4cc6d7aaa7bdf2a3c15a193c6d224.png'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:57px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:undefined;width:640px;'>
                <![endif]--><div style='cursor:auto;color:white;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:36px;font-weight:600;line-height:36px;text-align:center;'>Forgot Password!</div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table><!--[if mso | IE]>
                  </v:textbox>
                </v:rect>
                <![endif]--></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='margin:0px auto;max-width:640px;background:#ffffff;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:#ffffff;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:40px 70px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:0px 0px 20px;' align='left'><div style='cursor:auto;color:#737F8D;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:16px;line-height:24px;text-align:left;'>
                      <p><img src='https://cdn.discordapp.com/email_assets/127c95bbea39cd4bc1ad87d1500ae27d.png' alt='Party Wumpus' title='None' width='500' style='height: auto;'></p>
          
            <h2 style='font-family: Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-weight: 500;font-size: 20px;color: #4F545C;letter-spacing: 0.27px;'>Hey $this->first_name $this->last_name</h2>
          <p> We have generated a temperoary password for you . Login with this password and change your password to more secure password.</p>
          <p>Dont Forget To Change the password.</p>
          
                    </div></td></tr><tr><td style='word-break:break-word;font-size:0px;padding:10px 25px;' align='center'><table role='presentation' cellpadding='0' cellspacing='0' style='border-collapse:separate;' align='center' border='0'><tbody><tr><td style='border:none;border-radius:3px;color:white;cursor:auto;padding:15px 19px;' align='center' valign='middle' bgcolor='#7289DA'><a href='' style='text-decoration:none;line-height:100%;background:#7289DA;color:white;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:15px;font-weight:normal;text-transform:none;margin:0px;' target='_blank'>
                $password
                    </a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--></div><div style='margin:0px auto;max-width:640px;background:transparent;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:transparent;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:0px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;'><div style='font-size:1px;line-height:12px;'>&nbsp;</div></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='margin:0 auto;max-width:640px;background:#ffffff;box-shadow:0px 1px 5px rgba(0,0,0,0.1);border-radius:4px;overflow:hidden;'><table cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:#ffffff;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;font-size:0px;padding:0px;'><!--[if mso | IE]>
                <table border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:30px 70px 0px 70px;' align='center'><div style='cursor:auto;color:#43B581;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:18px;font-weight:bold;line-height:16px;text-align:center;'>FUN FACT #16</div></td></tr><tr><td style='word-break:break-word;font-size:0px;padding:14px 70px 30px 70px;' align='center'><div style='cursor:auto;color:#737F8D;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:16px;line-height:22px;text-align:center;'>
                In Hearthstone, using the Hunter card Animal Companion against Kel'Thuzad will summon his cat Mr. Bigglesworth rather than the usual beasts.
              </div></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]-->
                <!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='640' align='center' style='width:640px;'>
                  <tr>
                    <td style='line-height:0px;font-size:0px;mso-line-height-rule:exactly;'>
                <![endif]--><div style='margin:0px auto;max-width:640px;background:transparent;'><table role='presentation' cellpadding='0' cellspacing='0' style='font-size:0px;width:100%;background:transparent;' align='center' border='0'><tbody><tr><td style='text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;'><!--[if mso | IE]>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0'><tr><td style='vertical-align:top;width:640px;'>
                <![endif]--><div aria-labelledby='mj-column-per-100' class='mj-column-per-100 outlook-group-fix' style='vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;'><table role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'><tbody><tr><td style='word-break:break-word;font-size:0px;padding:0px;' align='center'><div style='cursor:auto;color:#99AAB5;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:12px;line-height:24px;text-align:center;'>
                Sent by Mactanse • <a href='http://localhost/projects/mini/index.php' style='color:#1EB0F4;text-decoration:none;' target='_blank'>check our blog</a> • <a href='http://localhost/projects/mini/index.php' style='color:#1EB0F4;text-decoration:none;' target='_blank'>@Mactanseapp</a>
              </div></td></tr><tr><td style='word-break:break-word;font-size:0px;padding:0px;' align='center'><div style='cursor:auto;color:#99AAB5;font-family:Whitney, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;font-size:12px;line-height:24px;text-align:center;'>
        
              </div></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>
                </td></tr></table>
                <![endif]--></div>
          
          </body>
          </body>
        </html>";

          $mail->send();
      
    
       


    }


}



?>