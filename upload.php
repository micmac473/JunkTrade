<?php 
$var=mysqli_connect("localhost","root","","test")or die("cannot connect to server"); 
//mysqli_select_db("test")or die("cannot select DB");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload image</title>
</head>


<body>


<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="file_img" />
<input type="submit" name="btn_upload" value="Upload">	
</form>


<?php
if(isset($_POST['btn_upload']))
{
	$filetmp = $_FILES["file_img"]["tmp_name"];
	$filename = $_FILES["file_img"]["name"];
	$filetype = $_FILES["file_img"]["type"];
	$filepath = "img/".$filename;
	
	move_uploaded_file($filetmp,$filepath);
	
	//$sql = "INSERT INTO upload_img (img_name,img_path,img_type) VALUES ('$filename','$filepath','$filetype')";
	//$result = mysqli_query($sql);
	mysqli_query($var,"INSERT INTO upload_img (img_name,img_path,img_type) VALUES ('$filename','$filepath','$filetype')");
}
?>


</body>
</html>


