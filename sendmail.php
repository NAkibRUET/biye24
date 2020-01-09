<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require_once('phpmailer/src/PHPMailer.php');
	require_once('phpmailer/src/Exception.php');
	require_once('phpmailer/src/SMTP.php');

	require_once('db_connect.php');
	if(isset($_GET['sendto'])){

		$check = $_GET['sendto'];
		
		//Created a template
		$sql = "SELECT * FROM tipshoi WHERE mail = ?";
		//Create a prepared statement
		$stmt = mysqli_stmt_init($con);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "Sql statement failed!";
		}
		else{
			//bind parameter
			mysqli_stmt_bind_param($stmt, 's', $check);
			//run
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
		/*}
		/*$rn = mysqli_query($con, "SELECT * FROM tipshoi WHERE gender = '$gender' ORDER BY id DESC");*/
			if(mysqli_num_rows($result)>0){
				$rw = mysqli_fetch_array($result);
				$name = $rw['name'];
			}
		}
	}
	if(isset($_POST['submit'])){
		$str = "qwertyuiopasdfghjklzxcvbnmMNBVCXZLKJHGFDSAPOIUYTREWQ0123456789#$&@!";
		$st2 = str_shuffle($str);
		$mail_key = substr($st2, 0, 12);
		echo $mail_key;
		$sql = "INSERT INTO `forget`(`mail`, `mail_key`) VALUES (?,?)";
		$stmt = mysqli_stmt_init($con);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "Sql statement failed!";
		}
		else{
			//bind parameter
			mysqli_stmt_bind_param($stmt, 'ss', $check, $mail_key);
			//run
			mysqli_stmt_execute($stmt);
			
		}

		/*$sendfrom = "biye24.com.bd@gmail.com";
        //$name =  $_POST['name'];
    	$mail = new PHPMailer();
    
    	$mail->Host = "smtp.gmail.com";
    
    	//$mail-isSMTP();
    
    	$mail->SMTPAuth = true;
    
    	$mail->Username = "biye24.com.bd@gmail.com";
    
    	$mail->Password = "lkjhgfdsa42742";
    
    	$mail->SMTPSecure = "ssl";
    
    	$mail->Port = 465;
    
    	$mail->Subject = "Reset Password | biye24";
    
        $mail->isHTML(true);
    	
    	$mail->Body = "<img src='https://www.biye24.com.bd/img/mail.png' width='400'>
    	<br>
    	<h2 style='color: #00A2E8;'>Hi, ".$name."</h2>
    	<h3 style='color: #000;'>To reset your password please follow the link below</h3>
    	<a href='https://biye24.com.bd/reset_password.php?user=$check&key=$mail_key'><h3>https://biye24.com.bd/reset_password.php?user=$check&key=$mail_key</h3></a>
    	<h3 style='color: #000;'>Thank you for being with biye24.com.bd";
    	$mail->setFrom($sendfrom,'biye24 bd');
    
    	$mail->addAddress($check);
    	
    	//$mail->addAttachment('logo2.png', 'Green Leaf');
    
    	if($mail->send()){
    		$msg = "<h5 style='color: blue;'>Mail Sent, Check your mail please and follow further instruction.</h5>";
    	}
    	else{
    		$msg = "<h5 style='color: red;'>Something went wrong.</h5>";
    	}*/
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>বিয়ে২৪</title>
	<link rel="icon" href="img/Logos.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.maateen.me/bangla/font.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" language="javascript" src="js/bal.min.js"></script>
</head>
<body style="background: #f9f9f9;">
	<div style="background: white; width: 340px; margin: 0 auto; margin-top: 10%; padding: 20px; box-shadow: 0 8px 16px rgba(0,0,0,0.25); border-radius: 10px;">

		<h5 style="color: #7f7f7f">Hi <span style="color: red;"><?php echo $name;?></span> পাসওয়ার্ড পরিবর্তন করতে নীচের বাটনে ক্লিক করুন।</h5>
		<br>
		<form method="post" action="">
			<button type="submit" name="submit" class="btn btn-danger form-control">Send Email?</button>
			
		</form>
		<div id="msg">
			<?php if(isset($msg)){echo $msg;}?>
		</div>
	</div>
</body>
</html>