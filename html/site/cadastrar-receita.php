<?php

	$link = mysqli_connect("mysql11.ricoreis.com", "ricoreis", "riconeskings@1","ricoreis") or print (mysqli_error()); 

	/* ------------------------------------------------------------------ */

	$descricao	= utf8_decode($_POST['descricao_r']);

	$valor		= $_POST['valor_r'];
	$valor		= floatval(str_replace(',','.',$valor));

	$categoria	= utf8_decode($_POST['categoria_r']);

	$dia		= $_POST['dia_r'];

	$cartao		= '0';

	/* ------------------------------------------------------------------ */

	$sql = "INSERT INTO bolso (descricao, valor, categoria, dia, cartao) VALUES ('$descricao', '$valor', '$categoria', '$dia', '$cartao')";

	if ( !mysqli_query($link,$sql) )
	{
		die('Error: ' . print mysqli_error());
	}

	echo "Receita cadastrada com sucesso!";
	 
	mysqli_close($link);

?>