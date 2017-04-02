<?php

	include ("libAngular.php");

	$result = allRequestDetails();

	header('Content-Type: application/json');
	echo json_encode(($result));

?>