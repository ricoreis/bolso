<?php

	$link = mysqli_connect("mysql11.ricoreis.com", "ricoreis", "riconeskings@1","ricoreis") or print (mysqli_error()); 

	/* ------------------------------------------------------------------ */

	//echo $_POST["dia1"]." >>> ".$_POST["dia2"]."<br><br>";

	function ConverteDia( $dia )
	{
		if( !empty($dia) )
		{
			$converte = $dia;
			$converte = explode("/",$converte);
			$converte = $converte[2]."-".$converte[1]."-".$converte[0];
			return $converte;
		}
	}

	function ConverteValor( $valor )
	{
		$converte = number_format($valor,2,",",".");
		return $converte;
	}

	/* ------------------------------------------------------------------ */

	$descricao	= utf8_decode( $_POST["descricao_p"] );
	$categoria	= utf8_decode( $_POST["categoria_p"] );
	$dia1		= ConverteDia( $_POST["dia1"] );
	$dia2		= ConverteDia( $_POST["dia2"] );

	//echo $descricao." >>> ".$categoria." >>> ".$dia1." >>> ".$dia2;

	/* ------------------------------------------------------------------ */

	//$sql = "SELECT * from bolso WHERE descricao LIKE '%".$descricao."%' AND dia BETWEEN '".$dia1."' AND '".$dia2."'";
	//$sql = "SELECT * from bolso WHERE categoria LIKE '%".$categoria."%' ";
	$sql = "SELECT * from bolso WHERE descricao LIKE '%".$descricao."%' ";

	$result = mysqli_query($link,$sql);

	$soma1 = mysqli_query($link,"SELECT SUM(valor) AS value_sum FROM bolso");
	$soma2  = mysqli_fetch_assoc($soma1);
	$soma3  = $soma2["value_sum"];

	$total = 0;

	echo "<table border='0' cellpadding='0' cellspacing='0'>";

		echo "<thead>";
			echo "<th>Descrição</th>";
			echo "<th align='right'>R$</th>";
			echo "<th>Categoria</th>";
			echo "<th>Data</th>";
		echo "</thead>";

	while ( $row = mysqli_fetch_array($result) ) {

		$dia_completa = date_parse( $row["dia"] );
		$dia_y = $dia_completa["year"];
		$dia_m = $dia_completa["month"];
		$dia_d = $dia_completa["day"];

		$total += $row["valor"];

		echo "<tr>";
			echo "<td>" . utf8_encode($row["descricao"]) . "</td>";
			echo "<td align='right'>" . ConverteValor($row["valor"]) . "</td>";
			echo "<td>" . utf8_encode($row["categoria"]) . "</td>";
			echo "<td>" . $dia_d ."/". $dia_m ."/". $dia_y. "</td>";
		echo "</tr>";

	}

		echo "<tfoot>";
			echo "<th>Total</th>";
			echo "<th align='right'>" . ConverteValor($total) . "</th>";
			echo "<th></th>";
			echo "<th></th>";
		echo "</tfoot>";

	echo "</table>";

?>