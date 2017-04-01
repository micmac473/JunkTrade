<?php

	include ("../lib.php");

	$result = allUserDetails();

	header('Content-Type: application/json');
	echo json_encode(($result));

?>