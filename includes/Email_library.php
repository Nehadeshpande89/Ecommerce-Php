<?php
//Load phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendEmail($email){

				       console.log("Comoing here")
			    		require 'vendor/autoload.php';

					    $mail = new PHPMailer(true);       

				        $mail->isSMTP();                                     
				        $mail->Host ='email-smtp.us-east-1.amazonaws.com';						                     
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'AKIA5VEIXVYZ7WCS6SEY';     
						$mail->Password = 'BHA/c8/k/EFXNdsp0ed10uwYZDHxhc2A3/jMvfOywsb7';						            
						$mail->sender = 'nehadeshpande1995@gmail.com';
				     	$mail->senderName = 'Neha Deshpande';
					    $mail->recipient = $email;                           
				        $mail->SMTPSecure = 'tls';                           
				        $mail->Port = 587;                                   
						$mail->SMTPOptions = array(
							'ssl' => array(  
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
							)
							);
				        $mail->setFrom($mail->sender,$mail->senderName);
				        
				        //Recipients
				        $mail->addAddress($mail->recipient);              
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = 'ECommerce Site Sign Up';
				        $mail->Body    = $message;

				        $mail->send();

                        }     
?>