<?php 


require 'phpmailer/class.phpmailer.php';
include 'phpmailer/class.smtp.php';

if(isset($_POST['action'])&& $_POST['action']!="") {
 
	if(!isset($_POST['username']) || $_POST['username'] == '') {
			// if no username was entered
			$contacterror["invalid_user"] = "Please enter a username";
		}
	else if (!preg_match("/^[a-zA-Z ]{2,50}$/",$_POST['username'])) { 
		$contacterror["invalid_user"] = "Please enter a valid username";
	}
    if(!isset($_POST['message']) || $_POST['message'] == '') {
			// if no message was entered
			$contacterror["invalid_message"] = "Please enter a message";
		}
	else if (preg_match("/(http|https):/i",$_POST['message'])) {
			$contacterror["invalid_message"] = "No url is allowed";
		}
	else if (preg_match("/^(www)/i",$_POST['message'])) { 
	         $contacterror["invalid_message"] = "No url is allowed";
	}
	if(!isset($_POST['city']) || $_POST['city'] == '') {
			// if no city was entered
			$contacterror["invalid_city"] = "Please enter a city";
		}
		else if (!preg_match("/^[a-zA-Z ]{2,50}$/",$_POST['city'])) { 
		$contacterror["invalid_city"] = "Please enter a valid City";
	}
    if(!isset($_POST['phone']) || $_POST['phone'] == '') {
			// if no phone was entered
			$contacterror["invalid_phone"] = "Please enter a phone";
		}
	else if (!preg_match("/^\d{10}$/",$_POST['phone'])) { 
	    $contacterror["invalid_phone"] = "Please enter a valid ten digit phone number";
	}
	if(!isset($_POST['email']) || $_POST['email'] == '') {
			// if no email was entered
			$contacterror["invalid_email"] = "Please enter a email";
		}
	else if (!preg_match("/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/",$_POST['email'])) {
            $contacterror["invalid_email"] = "Please enter a valid email";
	}	
 
	if((isset($contacterror["invalid_user"])|| isset($contacterror["invalid_message"])|| isset($contacterror["invalid_city"])|| isset($contacterror["invalid_phone"])|| isset($contacterror["invalid_email"]))&&!empty($contacterror))
		{
			 $response_array['status'] = 'error';
             $response_array['result'] = $contacterror;  			 
		}
	else
		{    
	      $response_array['status'] = 'success'; 
		  $name = $_POST['username'];	
		  $email = $_POST['email'];		
		  $phone = $_POST['phone'];	  
		  $msg = $_POST['message'];	
		  $city = $_POST['city'];	
		  $to = $_POST['email'];	
		  $subject = "Contact Us - Panditsriramguruji.com";	
		  $message1 = "<html>
     <head>
     <title>Contact Us</title>
     <style type='text/css'>
     table{font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; border-collapse:collapse;}
     table td{border:solid 1px #ccc; padding:5px;}
     </style>
     </head>
     <body>
     <table width='500' cellpadding='0' cellspacing='0'>
     <tr>
     <td colspan='2' align='center' bgcolor='#fff'>
						<img src='http://www.panditsriramguruji.com/images/logo.png'  />
	</td>
     </tr>
     <tr>
     <td width='20%'><strong>Name:</strong></td>
     <td>$name</td>
     </tr>
    <tr>				
     <td><strong>Phone</strong></td>				
		  <td>$phone</td>	
		  </tr>			
		  <tr>		
		  <td><strong>Email</strong></td>	
		  <td>$email</td>	
		  </tr>		
		  <tr>				
		  <td><strong>City</strong></td>	
		  <td>$city</td>	
		  </tr>		
		  <tr>				
		  <td><strong>Message:</strong></td>
		  <td>$msg</td>
		  </tr>	
     </table>
     </body>
     </html>
";
	 $message2 = "<html>
     <head>
     <title>Contact Us</title>
     <style type='text/css'>
     table{font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#333; border-collapse:collapse;}
     table td{border:solid 1px #ccc; padding:5px;}
     </style>
     </head>
     <body>
     <table width='500' cellpadding='0' cellspacing='0'>
	    <tr >
			<td colspan='2' >
				Hello $name,<br />
				Thank you for your interest. 
			    We have received following contact details from you:
			</td>
     </tr>
     <tr>
     <td colspan='2' align='center' bgcolor='#fff'>
						<img src='http://www.panditsriramguruji.com/images/logo.png'  />
	 </td>
     </tr>
     <tr>
     <td width='20%'><strong>Name:</strong></td>
     <td>$name</td>
     </tr>
     <tr>
     <td><strong>Email:</strong></td>
     <td>$email</td>
     </tr>
     <tr>
     <td width='20%'><strong>Phone No:</strong></td>
     <td>$phone</td>
     </tr>
     <tr>
     <td><strong>City living in:</strong></td>
     <td>$city</td>
     </tr>
     <tr>
     <td><strong>Your question/query:</strong></td>
     <td>$msg</td>
     </tr>
	 <tr>
     <td colspan='2' >
     <p> We will very soon get in touch with you to take things forward. In the meanwhile, You can always call 780-255-1666 if you have any questions.<p>
       <p> Your privacy is important to us. We will never share your information.</p>
        <p> Warm Regards, </p>
    <p>Pandit Sriram Guruji</p>
    
	  </td>
     </tr>
     </table>
     </body>
     </html>
";

/*php mailer*/		  

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'shivji1astro1@gmail.com';                // SMTP username
$mail->Password = 'shivji1@123';                  // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'shivji1astro1@gmail.com';
$mail->FromName = 'panditsriramguruji';
//$mail->AddAddress('shivajiseo@gmail.com');               // Name is optional
$mail->AddAddress('shivji1astro1@gmail.com');               // Name is optional

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Contact Us - Panditsriramguruji.com';
$mail->Body    =$message1;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

/*php mailer*/		
	if($mail->Send()) {
		    $mail1 = new PHPMailer;
            $mail1->IsSMTP();                                      // Set mailer to use SMTP
			$mail1->Host = 'smtp.gmail.com';                 // Specify main and backup server
			$mail1->Port = 587;                                    // Set the SMTP port
			$mail1->SMTPAuth = true;                               // Enable SMTP authentication
			$mail1->Username = 'shivji1astro1@gmail.com';                // SMTP username
			$mail1->Password = 'shivji1@123';                  // SMTP password
			$mail1->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

			$mail1->From = 'shivji1astro1@gmail.com';
			$mail1->FromName = 'Panditsriramguruji';
			$mail1->AddAddress($_POST['email']);  // Add a recipient
			//$mail->AddAddress('ellen@example.com');               // Name is optional

			$mail1->IsHTML(true);                                  // Set email format to HTML

			$mail1->Subject = 'Contact Us - Panditsriramguruji.com';
			$mail1->Body    =$message2;
			if($mail1->Send()) {
				
			}
       }
	    }
 
} else {
   $response_array['status'] = 'error';  
}


echo json_encode($response_array);
?>
