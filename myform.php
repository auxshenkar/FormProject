<?php
	header('Content-Type: text/html; charset=utf-8');
	 //create a mySQL DB connection:
	$dbhost = "166.62.8.11";
	$dbuser = "auxstudDB5";
	$dbpass = "auxstud5DB1!";
	$dbname = "auxstudDB5";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	//testing connection success
	if(mysqli_connect_errno()) {
	 	die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
	}
	//if data was sent, save it and display in the list
	if(isset($_POST['saveIntoServer'])){    
		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	 	$name = mysqli_real_escape_string($connection, $_POST['myName']);
	 	$mail = mysqli_real_escape_string($connection, $_POST['myMail']);
		$github = mysqli_real_escape_string($connection, $_POST['myGithub']);
		$quote = mysqli_real_escape_string($connection, $_POST['myQuote']);
	 	$linkedin = mysqli_real_escape_string($connection, $_POST['myLinkedin']);
		$url = mysqli_real_escape_string($connection, $_POST['myUrl']);
		$cyber = 0;
		$mobile = 0;
		$analitics = 0;
		$web = 0;
		$noSpecialist = 0;
		$quote = str_replace	('+-+', '-', $quote);
		$github = str_replace	('+-+', '-', $github);
		$url = str_replace		('+-+', '-', $url);
		$linkedin = str_replace ('+-+', '-', $linkedin);
		$mail = str_replace		('+-+', '-', $mail);
		
		foreach($_POST['specialist'] as $value){
				if($value == "analitics") $analitics++;
				else if($value == "cyber") $cyber++;
				else if($value == "mobile") $mobile++;
				else if($value == "web") $web++;
				else  $noSpecialist++;
			} 	
		$target_dir_profile = "images/uploads/profile/";
		$target_dir_standpicture = "images/uploads/standpicture/";
		$target_dir_projectpicture = "images/uploads/projectpicture/";
		$target_dir_cvfile = "images/uploads/cvUploads/";
		$target_file_profile = $target_dir_profile .$id. "profile.jpg"; 
		$target_file_standpicture = $target_dir_standpicture . $id. "standpicture.jpg";
		$target_file_projectpicture1 = $target_dir_projectpicture . $id. "projectpicture1.jpg";
		$target_file_projectpicture2 = $target_dir_projectpicture . $id. "projectpicture2.jpg";
		$target_file_projectpicture3 = $target_dir_projectpicture . $id. "projectpicture3.jpg";
		$target_file_cv = $target_dir_cvfile .$id. "cv.doc"; 
		$uploadOk = 1;
		$picture_exist = array("true","true","true","true","true");
		$cv_upload = "true";	
		
		if (file_exists($target_file_profile)) {
		    $picture_exist[0] = "false";
		}
		if (file_exists($target_file_standpicture)) {
		    $picture_exist[1] = "false";
		}
		if (file_exists($target_file_projectpicture1)) {
		    $picture_exist[2] = "false";
		}
		if (file_exists($target_file_projectpicture2)) {
		    $picture_exist[3] = "false";
		}
		if (file_exists($target_file_projectpicture3)) {
		    $picture_exist[4] = "false";
		}
		if (file_exists($target_file_cv)) {
	    $cv_upload = "false";
		}
		
			
			
		
		if ($uploadOk == 1) {
			if($picture_exist[0]== "true")  move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file_profile);
			if($picture_exist[1]== "true")	move_uploaded_file($_FILES["standPicture"]["tmp_name"], $target_file_standpicture);
			if($picture_exist[2]== "true")	move_uploaded_file($_FILES["projectPicture1"]["tmp_name"], $target_file_projectpicture1);
			if($picture_exist[3]== "true")	move_uploaded_file($_FILES["projectPicture2"]["tmp_name"], $target_file_projectpicture2);
			if($picture_exist[4]== "true")	move_uploaded_file($_FILES["projectPicture3"]["tmp_name"], $target_file_projectpicture3);
			if($cv_upload== "true")			move_uploaded_file($_FILES["cvFile"]["tmp_name"], $target_file_cv);
		
		
		
		$query = "UPDATE tbl_formData_215 ".
		"SET mail ='".$mail."' ,analitics = '".$analitics."' ,web='".$web."' ".
		",mobile='".$mobile."' ,cyber='".$cyber."' ,noSpecialist='".$noSpecialist."'".
		",github='".$github."' ,quote='".$quote."' ,linkedin='".$linkedin."' ,url='".$url."' ".
		"WHERE id='".$id."'";
		$res = mysqli_query($connection, $query);
		echo "פרטיך הועלו בהצלחה למערכת";
		}
	}	
	
	//close DB connection
	mysqli_close($connection);	
?>		