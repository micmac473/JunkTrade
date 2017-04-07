<?php
	include ("libAngular.php");

	$result = userOnlineDetails();

	header('Content-Type: application/json');
	echo json_encode(($result));

?>