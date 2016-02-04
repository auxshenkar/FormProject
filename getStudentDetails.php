<?php
	header('Content-Type: text/html; charset=utf-8');
	 //create a mySQL DB connection:
	$dbhost = "166.62.8.11";
	$dbuser = "auxstudDB5";
	$dbpass = "auxstud5DB1!";
	$dbname = "auxstudDB5";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	//testing connection success
	if(mysqli_connect_errno()) 
	{
	 	die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
	 	
		);
	}
	$id = $_GET['studentId'];
	
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
	$query = "SELECT * FROM tbl_formData_215 WHERE id='".$id."'";
	$result = mysqli_query($connection, $query);
	$row = $result->fetch_assoc();    // get the row where id = student id
	
	$studentData = array($row["name"],$row["id"],$row["mail"],$row["analitics"],$row["web"],
	$row["mobile"],$row["cyber"],$row["noSpecialist"],$row["github"],$row["quote"],
	$row["linkedin"],$row["url"],$picture_exist[0],$picture_exist[1],$picture_exist[2],$picture_exist[3],
	$picture_exist[4],$cv_upload);
	
	$comma_separated = implode("+-+", $studentData);   // make all the array like : name,id,web,analitics
	echo $comma_separated;	
	 
	mysqli_close($connection);	
?>