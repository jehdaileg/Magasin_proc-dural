<?php

function secure_datas($data)
{
	$data = htmlentities($data);
	$data = htmlspecialchars($data);
	$data = strip_tags($data);
	$data = stripslashes($data);

	return $data;
}


?>