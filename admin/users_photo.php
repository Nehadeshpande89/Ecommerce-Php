<?php
	include 'includes/session.php';
	require 'vendor/autoload.php';


	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE users SET photo=:photo WHERE id=:id");
			$stmt->execute(['photo'=>$filename, 'id'=>$id]);
			$_SESSION['success'] = 'User photo updated successfully';
			
            $s3 = new Aws\S3\S3Client([
                'region'  => 'us-east-1',
                'version' => 'latest',
                'credentials' => [
                    'key'    => "AKIA5VEIXVYZ5SKBNQ55-",
                    'secret' => "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",
                ]
            ]);     
 
            $result = $s3->putObject([
                'Bucket' => 's3-ecomm',
                'Key'    => 'testing/' + $filename,
			    'ACL' => 'public-read'       
            ]);  
 
          var_dump($result);  

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select user to update photo first';
	}

	header('location: users.php');
?>