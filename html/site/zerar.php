<?php

	$link = mysqli_connect("localhost:3306","root","","ricoreis") or print (mysqli_error()); 

	$sql = "TRUNCATE TABLE teste";

	if( mysqli_query($link,$sql) )
	{
		echo "tabela zerada";
	}
	else
	{
		echo "falha";
	}

?>