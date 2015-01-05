<?php

	$link = mysqli_connect("mysql11.ricoreis.com", "ricoreis", "riconeskings@1","ricoreis") or print (mysqli_error()); 

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