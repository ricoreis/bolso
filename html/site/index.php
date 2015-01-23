<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Meu Bolso</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="assets/js/funcoes.js"></script>
	<script type="text/javascript" src="assets/js/accounting.min.js"></script>
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
			width: 90%;
			max-width: 320px;
			margin: 0 auto;
			position: relative;
		}

		#inicio {
			width: 100%;
			float: left;
			margin: 20px 0 20px 0;
		}

		input, select {
			border: 0;
			outline: none;
			height: 50px;
			padding: 5px;
			margin: 0 0 8px 0;
			width: 100%;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			text-indent: 10px;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			background-color: #FFF;
		}

		input[type=submit] {
			padding: 0;
			/*font-size: 1.1em;*/
			/*font-weight: 700;*/
			margin: 0 0 30px 0;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			background-color: #CCC;
			text-indent: 0;
		}

		#titulo {
			color: white;
			text-align: center;
			width: 100%;
			font-size: 20pt;
			margin: 15px 0 15px 0;
		}

		.erro {
			background-color: #f6cac9;
		}

		.ativo {
			color: #fff;
			background: #666;
			-webkit-box-shadow:inset 1px 1px 5px 2px rgba(0,0,0,0.15);
			box-shadow:inset 1px 1px 5px 2px rgba(0,0,0,0.15);
		}

		#aguarde {
			background: rgba(0,0,0,0.5);
		}

		#erro {
			background: #cc2e2e;
		}

		#erro p,
		#aguarde p,
		#sucesso p {
			width: 320px;
			margin: 140px auto;
			min-width: 320px;
			color: #fff;
			text-align: center;
			font-size: 18pt;
		}

		#mais {
			border: 1px dotted #ccc;
			outline: none;
			height: 50px;
			line-height: 50px;
			text-align: center;
			margin: 0 0 8px 0;
			width: 100%;
			float: left;
			color: #ccc;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
		}


	</style>

</head>
<body>

	<div id="geral">





		<!-- ################################################################################################### -->
		<!-- ABAS -->
		<!-- ################################################################################################### -->

		<div id="inicio">
			&nbsp;
		</div>





		<!-- ################################################################################################### -->
		<!-- INSERIR GANHO -->
		<!-- ################################################################################################### -->

		<div id="login">

			<form id="formulario-login">

				<div style="width: 100%; float: left;">
					<input type="text" id="usuario" name="usuario" placeholder="Usuário" />
				</div>

				<div style="width: 100%; float: left;">
					<input type="text" id="senha" name="senha" placeholder="Senha" />
				</div>

				<div style="width: 100%; float: left;">
					<input type="submit" value="Login" />
				</div>

			</form>

		</div>





		<!-- ################################################################################################### -->
		<!-- MENSAGENS -->
		<!-- ################################################################################################### -->

		<div id="sucesso">
			<p>
				Sucesso!
			</p>
		</div>

		<div id="aguarde">
			<p>
				Aguarde...
			</p>
		</div>

		<div id="erro">
			<p>
				Ops!
			</p>
		</div>





	</div>



	<script>
		$(document).ready(function() {





			// ------------------------------------------------------------------------------------------------
			// NÃO EXIBE MENSAGENS NO HTML
			// ------------------------------------------------------------------------------------------------

			$.validator.messages.required = '';





			// ------------------------------------------------------------------------------------------------
			// SUBMETE RECEITA
			// ------------------------------------------------------------------------------------------------

			$("#formulario-login").validate({

				rules: {
					usuario: { required: true },
					senha: { required: true },
				},

				highlight: function(element){ $(element).addClass('erro'); },
				unhighlight: function(element){ $(element).removeClass('erro'); },

				submitHandler: function(form){
					$("#aguarde").fadeIn();
					$.ajax({
						url: 'login.php',
						type:'POST',
						data: $(form).serialize(),
						success: function(){

							window.location = "bolso.php";

						},
						error:function(){

							$("#erro p").html("Ops!");
							$("#aguarde").hide();
							$("#erro").fadeIn();
							$("#erro").delay(2000).fadeOut();

						}
					});
					return false;
				}

			});





		});
	</script>

</body>
</html>