<?php

	include ("libAngular.php");

	$result = allItemDetails();

	header('Content-Type: application/json');
	echo json_encode(($result));

?>