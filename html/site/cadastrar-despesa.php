<?php

	$link = mysqli_connect("mysql11.ricoreis.com", "ricoreis", "riconeskings@1","ricoreis") or print (mysqli_error()); 

	/* ------------------------------------------------------------------ */

	$descricao	= utf8_decode($_POST['descricao']);

	$valor		= '-'.$_POST['valor'];
	$valor		= floatval(str_replace(',','.',$valor));

	$categoria	= utf8_decode($_POST['categoria']);

	$dia		= $_POST['dia'];

	$cartao		= utf8_decode($_POST['cartao']);

	/* ------------------------------------------------------------------ */

	$sql = "INSERT INTO bolso (descricao, valor, categoria, dia, cartao) VALUES ('$descricao', '$valor', '$categoria', '$dia', '$cartao')";

	if ( !mysqli_query($link,$sql) )
	{
		die('Error: ' . print mysqli_error());
	}

	echo "Item cadastrado com sucesso!";
	 
	mysqli_close($link);

?>