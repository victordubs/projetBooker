<?php
	$result = array() ;
	$result["status"] = "success" ;

	// Normalement, ici : insertion ou mise � jour de la base
	if (isset($_result["id"])) {
		$result['msg'] =$_REQUEST["roles"];
		}
			echo json_encode($result);

?>
