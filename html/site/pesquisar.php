<?php

	$link = mysqli_connect("mysql11.ricoreis.com", "ricoreis", "riconeskings@1","ricoreis") or print (mysqli_error()); 

	/* ------------------------------------------------------------------ */

	function ConverteValor( $valor )
	{
		$converte = number_format($valor,2,",",".");
		return $converte;
	}

	/* ------------------------------------------------------------------ */

	$hoje 		= date("Y-m-d");
	$descricao	= utf8_decode( $_POST["descricao_p"] );
	$categoria	= utf8_decode( $_POST["categoria_p"] );
	$tipo		= $_POST["tipo_p"];
	$periodo	= $_POST["periodo_p"];
	$dia1		= $_POST["dia1"];
	$dia2		= $_POST["dia2"];

	//echo $descricao." > ".$categoria." > ".$periodo." > ".$tipo." > ".$dia1." > ".$dia2;

	/* ------------------------------------------------------------------ */

	$sql =	"SELECT * from bolso

			WHERE ( descricao LIKE '%".$descricao."%' OR descricao IS NULL )";

	if( $tipo == "r" )
	{
		$sql .= "AND ( valor > 0 )";
	}
	elseif ( $tipo == "d" )
	{
		$sql .= "AND ( valor < 0 )";
	}

	$sql .= "AND ( categoria LIKE '%".$categoria."%' OR categoria IS NULL )";

	if( $periodo > 365 )
	{
		$sql .= "AND dia BETWEEN '".$periodo."-01-01' AND '".$periodo."-12-31' ";
	}
	else
	{
		$sql .= "AND dia BETWEEN DATE_SUB( NOW(), INTERVAL ".$periodo." DAY ) AND NOW()";
	}

	$sql .= "ORDER BY dia DESC";

	/* ------------------------------------------------------------------ */

	$result = mysqli_query($link,$sql);

	$soma1 = mysqli_query($link,"SELECT SUM(valor) AS value_sum FROM bolso");
	$soma2  = mysqli_fetch_assoc($soma1);
	$soma3  = $soma2["value_sum"];

	$total = 0;

	echo "<table border='0' cellpadding='2' cellspacing='2'>";

		echo "<thead>";
			echo "<th>Descrição</th>";
			echo "<th align='right'>R$</th>";
			echo "<th>Categoria</th>";
			echo "<th>Data</th>";
			echo "<th></th>";
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
			echo "<td><a href='javascript:Teste()' id='item-". ($row["id"]) ."'>&nbsp;x&nbsp;</a></td>";
		echo "</tr>";

	}

		echo "<tfoot>";
			echo "<th>Total</th>";
			echo "<th align='right'>" . ConverteValor($total) . "</th>";
			echo "<th></th>";
			echo "<th></th>";
			echo "<th></th>";
		echo "</tfoot>";

	echo "</table>";

?>