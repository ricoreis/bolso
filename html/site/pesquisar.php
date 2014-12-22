<?php

	header ('Content-type: text/html; charset=UTF-8');
	$link = mysqli_connect("localhost:3306","root","","ricoreis") or print (mysqli_error()); 

?>

<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Vai ser Festa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="assets/js/funcoes.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/jquery-validation/dist/jquery.validate.min.js"></script>

	<!-- <script type="text/javascript" src="assets/js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script> -->
	<!-- <link href="assets/js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/> -->

	<script type="text/javascript" src="assets/js/jquery-mobile-datepicker/jquery.mobile.datepicker.js"></script>
	<link href="assets/js/jquery-mobile-datepicker/jquery.mobile.datepicker.css" rel="stylesheet" type="text/css"/>

	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/estilo.css" rel="stylesheet" type="text/css"/>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>

	<style>

		#geral {
			width: 80%;
			max-width: 320px;
			margin: 0 auto;
		}

		input, select {
			border: 0;
			outline: none;
			width: 100%;
			height: 50px;
			line-height: 50px;
			padding: 5px;
			margin: 0 0 8px 0;
			text-align: center;
			-webkit-border-radius: 3px;
			border-radius: 3px;
		}

		input[type=submit] {
			padding: 0;
			font-size: 1.1em;
			font-weight: 700;
			margin: 0 0 60px 0;
		}

		#titulo {
			color: white;
			text-align: center;
			width: 100%;
			font-size: 24pt;
			margin: 60px 0 30px 0;
		}

		.erro {
			background-color: #f1f1f1;
		}

	</style>

</head>
<body>

	<div id="geral">

		<p id="titulo">
			Pesquisar Gastos
		</p>

		<!--<form id="formulario" action="cadastro.php" method="post">-->
		<form id="formulario">

			<input type="text" id="descricao" name="descricao" placeholder="Descrição" />

			<?php

				$sql = "SELECT * from categorias ORDER BY categoria";
				$result = mysqli_query($link,$sql);
				echo "<select name='categoria'>";
				echo "<option value='0'>Selecione categoria</option>";
				while ( $row = mysqli_fetch_array($result) ) {
				    echo "<option value='" . utf8_encode($row["categoria"]) . "'>" . utf8_encode($row["categoria"]) . "</option>";
				}
				echo "</select>";

			?>

			<input type="text" id="dia1" name="dia1" class="date-input-inline" placeholder="De" data-inline="true" data-role="date" readonly="true" />
			<input type="text" id="dia2" name="dia2" class="date-input-inline" placeholder="Até" data-inline="true" data-role="date" readonly="true" />

			<input type="submit" value="OK" />

		</form>

	</div>

	<div id="resultado"></div>

	<script>
		$(document).ready(function() {




			// ------------------------------------------------------------------------------------------------
			// CHECKBOX DO CARTÃO
			// ------------------------------------------------------------------------------------------------

			$("#cartao-check").click(function(){
				if( $(this).prop('checked')==true )
				{
					$('#cartao').show();
				}
				else
				{
					$('#cartao').hide();
				}
			});




			// ------------------------------------------------------------------------------------------------
			// DATA
			// ------------------------------------------------------------------------------------------------

			var dia = new Date();
			var hoje = dia.getDate() +"/"+ (dia.getMonth()+1) +"/"+ dia.getFullYear();
			//$("#dia1").val("Hoje");
			//$("#dia2").val("Hoje");

			$("#dia1").datepicker({
				dateFormat: "dd/mm/yy",
				inline: true
			});

			$("#dia2").datepicker({
				dateFormat: "dd/mm/yy",
				inline: true
			});




			// ------------------------------------------------------------------------------------------------
			// SUBMETE FORMULÁRIO
			// ------------------------------------------------------------------------------------------------

			// SUBMETE
			$("#formulario").validate({

				submitHandler: function(form){
					$.ajax({
						url: 'consultar.php',
						type:'POST',
						data: $(form).serialize(),
						success: function(msg){
							//alert(msg);
							$("#resultado").html(msg);
						},
						error:function(msg){
						}
					});
					return false;
				}

			});




		});
	</script>

</body>
</html>