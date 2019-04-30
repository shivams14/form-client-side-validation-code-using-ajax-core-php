<?php

	$mailname = $_POST['name'];
	$mailphone = $_POST['phone'];
	$mailemail = $_POST['email'];
	$maildob = $_POST['dob'];
	$mailmsg = $_POST['message'];
	
	
	$mailsubject = 'Quick Contact - Pandit Murthy';
	$mailmessage = "<html>
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
					<td colspan='2' align='center' bgcolor='#ee8712'>
					<img src='http://www.astrologermurthy.com/images/logo.png' alt='logo'>
					</td>
					</tr>
					<tr>
					<td width='20%'><strong>Name:</strong></td>
					<td>$mailname</td>
					</tr>
					<tr>
					<td width='20%'><strong>Phone:</strong></td>
					<td>$mailphone</td>
					</tr>
					<tr>
					<td width='20%'><strong>Email:</strong></td>
					<td>$mailemail</td>
					</tr>
					<tr>
					<td width='20%'><strong>Date of Birth:</strong></td>
					<td>$maildob</td>
					</tr>
					<tr>
					<td><strong>Message:</strong></td>
					<td>$mailmsg</td>
					</tr>
					
					</table>
					</body>
					</html>";
	
	$mailmessage1 = "<html>
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
					<td colspan='2' align='center' bgcolor='#ee8712'>
					<img src='http://www.astrologermurthy.com/images/logo.png' alt='logo'>
					</td>
					</tr>
					<tr>
					<td colspan='3'>
					<strong>Hello $mailname</strong>
					<p color='#000'>Thank you for your interest in our Services.We have received following contact details from you:</p>
					</td>
					</tr>
					<tr>
					<td width='20%'><strong>Name:</strong></td>
					<td>$mailname</td>
					</tr>
					<tr>
					<td width='20%'><strong>Phone:</strong></td>
					<td>$mailphone</td>
					</tr>
					<tr>
					<td width='20%'><strong>Email:</strong></td>
					<td>$mailemail</td>
					</tr>
					<tr>
					<td width='20%'><strong>Date of Birth:</strong></td>
					<td>$maildob</td>
					</tr>
					<tr>
					<td><strong>Message:</strong></td>
					<td>$mailmsg</td>
					</tr>
					<tr>
					<td colspan='3'>
					<strong>Warm Regards,</strong> 
					<p>Pandit Murthy</p>
					<p>Website - www.astrologermurthy.com</p>
					<p>Address - 2/10 Albert crescent St Albans 3021</p>
					<p>Phone:  0451489991</p>
					<p>Email: panditragudeva@gmail.com</p>
					</td>
					</tr>
							
					</table>
					</body>
					</html>";


	
	require 'PHPMailer/PHPMailerAutoload.php';
	require 'PHPMailer/class.phpmailer.php'; 
	require 'PHPMailer/class.smtp.php';

	$mail = new PHPMailer;

	$mail->SMTPDebug = 0;
	// SMTP configuration
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = "psychicastrologerdeva@gmail.com";			
	$mail->Password = "raghudeva#123@";
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->From      = 'psychicastrologerdeva@gmail.com';
	$mail->FromName  = "Pandit Murthy";
	$mail->Subject   = $mailsubject;
	$mail->WordWrap = 50;
	$mail->isHTML(true);
	//$mail->AddEmbeddedImage('/home/p3923zm09mr2/public_html/msplussizeindia2019/images/logo.png', 'logo_2u');<img src='cid:logo_2u' />
	$mail->Body      = $mailmessage;
	$mail->AddAddress("panditragudeva@gmail.com");
	$mail->AddBCC("leads.daksha@gmail.com");
		if($mail->Send()){
			$mail_reply = new PHPMailer;
			$mail_reply->SMTPDebug = 0;
			$mail_reply->isSMTP();
			$mail_reply->Host = 'smtp.gmail.com';
			$mail_reply->SMTPAuth = true;
			$mail_reply->Username = "psychicastrologerdeva@gmail.com";			
			$mail_reply->Password = "raghudeva#123@";
			$mail_reply->SMTPSecure = 'ssl';
			$mail_reply->Port = 465;
			$mail_reply->From      = 'psychicastrologerdeva@gmail.com';
			$mail_reply->FromName  = 'Pandit Murthy';
			$mail_reply->Subject   = $mailsubject;
			$mail_reply->WordWrap = 50;
			$mail_reply->isHTML(true); 
			$mail_reply->Body   = $mailmessage1;
			$mail_reply->AddAddress($mailemail);
				if ($mail_reply->Send()){
					//header("location: thankyou.php");
					echo "Mail Sent!";
				}
		}

?>