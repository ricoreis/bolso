<?php

	$link = mysqli_connect("localhost:3306","root","","ricoreis") or print (mysqli_error()); 

	/* ------------------------------------------------------------------ */

	$descricao	= utf8_decode($_POST['descricao']);

	$valor		= $_POST['valor'];
	$valor		= floatval(str_replace(',','.',$valor));

	$categoria	= utf8_decode($_POST['categoria']);

	$dia		= $_POST['dia'];
	$dia		= explode('/',$dia);
	$dia		= $dia[2].'-'.$dia[1].'-'.$dia[0];

	$cartao		= utf8_decode($_POST['cartao']);

	/* ------------------------------------------------------------------ */
/*
	$descricao	= "CEG";
	$valor		= "120";
	$categoria	= "Carro";
	$dia		= "2014-12-12";
	$cartao		= "-";
*/
	/* ------------------------------------------------------------------ */

	$sql = "INSERT INTO gastos (descricao, valor, categoria, dia, cartao) VALUES ('$descricao', '$valor', '$categoria', '$dia', '$cartao')";

	if ( !mysqli_query($link,$sql) )
	{
		die('Error: ' . print mysqli_error());
	}

	echo "Item cadastrado com sucesso!";
	 
	mysqli_close($link);

?>