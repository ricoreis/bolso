<?php

	$link = mysqli_connect("localhost:3306","root","","ricoreis") or print (mysqli_error()); 

	/* ------------------------------------------------------------------ */

	echo $_POST["dia1"]." >>> ".$_POST["dia2"]."<br><br>";

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

	$descricao	= utf8_decode( $_POST["descricao"] );
	$categoria	= utf8_decode( $_POST["categoria"] );
	$dia1		= ConverteDia( $_POST["dia1"] );
	$dia2		= ConverteDia( $_POST["dia2"] );

	echo $descricao." >>> ".$categoria." >>> ".$dia1." >>> ".$dia2;

	/* ------------------------------------------------------------------ */

	//$sql = "SELECT * from gastos WHERE descricao LIKE '%".$descricao."%' AND dia BETWEEN '".$dia1."' AND '".$dia2."'";
	$sql = "SELECT * from gastos WHERE descricao LIKE '%".$descricao."%' ";

	$result = mysqli_query($link,$sql);

	$soma1 = mysqli_query($link,"SELECT SUM(valor) AS value_sum FROM gastos");
	$soma2  = mysqli_fetch_assoc($soma1);
	$soma3  = $soma2["value_sum"];

	$total = 0;

	echo "<table border='1' cellpadding='10' cellspacing='0'>";

		echo "<thead>";
			echo "<th>Descrição</th>";
			echo "<th align='right'>R$</th>";
			echo "<th>Categoria</th>";
			echo "<th>Dia</th>";
			echo "<th>Mês</th>";
			echo "<th>Ano</th>";
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
			echo "<td>" . $dia_d . "</td>";
			echo "<td>" . $dia_m . "</td>";
			echo "<td>" . $dia_y . "</td>";
		echo "</tr>";

	}

		echo "<tfooter>";
			echo "<th>Total</th>";
			echo "<th align='right'>" . ConverteValor($total) . "</th>";
			echo "<th></th>";
			echo "<th></th>";
			echo "<th></th>";
			echo "<th></th>";
		echo "</tfooter>";

	echo "</table>";

?>