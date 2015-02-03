<?php

	header ('Content-type: text/html; charset=UTF-8');
	$link = mysqli_connect("mysql11.ricoreis.com", "ricoreis", "riconeskings@1","ricoreis") or print (mysqli_error()); 

?>

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

		#receita,
		#despesa,
		#despesa-cartao,
		#pesquisa {
			width: 100%;
			float: left;
		}

		#receita,
		#despesa,
		#despesa-cartao,
		#pesquisa,
		#cartao-detalhe,
		#cartao-lista {
			display: none;
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

		select {
			line-height: 40px;
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

		input[type=date] {
			line-height: 30px;
			font-size: 11pt;
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

		ul {
			width: 100%;
			list-style: none;
			margin: 0 0 0 0;
			padding: 0;
		}

		ul li {
			width: 22%;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			cursor: pointer;
			height: 50px;
			line-height: 50px;
			margin: 0 4% 5px 0;
			float: left;
			text-align: center;
			color: #999;
			font-size: 11pt;
			-webkit-box-shadow:inset 1px 1px 5px 2px rgba(0,0,0,0.0);
			box-shadow:inset 1px 1px 5px 2px rgba(0,0,0,0.0);
		}

		ul li:last-child {
			margin: 0 0 5px 0;
		}

		.ativo {
			color: #fff;
			background: #666;
			-webkit-box-shadow:inset 1px 1px 5px 2px rgba(0,0,0,0.15);
			box-shadow:inset 1px 1px 5px 2px rgba(0,0,0,0.15);
		}

		table {
			width: 100%;
			color: #fff;
			border: 0;
			outline: none;
			font-size: 10pt;
		}

		thead,
		tfoot {
			background: #8a8a8a;
			color: #ccc;
			font-weight: 300;
		}

		#sucesso,
		#erro,
		#aguarde {
			width: 100%;
			height: 100%;
			position: fixed;
			top: 0;
			left: 0;
			display: none;
		}

		#sucesso {
			background: #46bb43;
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

		.numero {
			border: 0;
			outline: none;
			height: 50px;
			width: 50px;
			line-height: 50px;
			-webkit-border-radius: 3px 0 0 3px;
			border-radius: 3px 0 0 3px;
			text-align: center;
			background-color: #ccc;
			position: absolute;
			top: 0;
			left: 0;
		}

		.cartao-item {
			text-indent: 60px;
		}

	</style>

</head>
<body>

	<div id="geral">





		<!-- ################################################################################################### -->
		<!-- ABAS -->
		<!-- ################################################################################################### -->

		<div id="inicio">
			
			<ul>
				<li id="mn-receita">Receita</li>
				<li id="mn-despesa">Despesa</li>
				<li id="mn-despesa-cartao">Cartão</li>
				<li id="mn-pesquisa">Pesquisa</li>
			</ul>

		</div>





		<!-- ################################################################################################### -->
		<!-- INSERIR GANHO -->
		<!-- ################################################################################################### -->

		<div id="receita">

			<form id="formulario-receita">

				<div style="width: 100%; float: left;">
					<input type="text" id="descricao_r" name="descricao_r" placeholder="Descrição" />
				</div>

				<div style="width: 40%; float: left;">
					<input type="number" step="0.01" min="0" id="valor_r" name="valor_r" placeholder="Valor" class="input50" />
				</div>

				<div style="width: 58%; float: left; margin: 0 0 0 2%;">
					<?php

					$sql = "SELECT * from receita ORDER BY categoria";
					$result = mysqli_query($link,$sql);
					echo "<select name='categoria_r'>";
					echo "<option value=''>Selecione categoria</option>";
					while ( $row = mysqli_fetch_array($result) ) {
						echo "<option value='" . utf8_encode($row["categoria"]) . "'>" . utf8_encode($row["categoria"]) . "</option>";
					}
					echo "</select>";

					?>
				</div>

				<div style="width: 100%; float: left;">
					<input type="date" id="dia_r" name="dia_r" placeholder="Data" class="input100" />
				</div>

				<div style="width: 100%; float: left;">
					<input type="submit" value="Cadastrar receita" />
				</div>

			</form>

		</div>





		<!-- ################################################################################################### -->
		<!-- INSERIR GASTO SIMPLES -->
		<!-- ################################################################################################### -->

		<div id="despesa">

			<form id="formulario-despesa">

				<div style="width: 100%; float: left;">
					<input type="text" id="descricao" name="descricao" placeholder="Descrição" />
				</div>

				<div style="width: 40%; float: left;">
					<input type="number" step="0.01" min="0" id="valor" name="valor" placeholder="Valor" class="input50" />
				</div>

				<div style="width: 58%; float: left; margin: 0 0 0 2%;">
					<?php

					$sql = "SELECT * from despesas ORDER BY categoria";
					$result = mysqli_query($link,$sql);
					echo "<select name='categoria'>";
					echo "<option value=''>Selecione categoria</option>";
					while ( $row = mysqli_fetch_array($result) ) {
						echo "<option value='" . utf8_encode($row["categoria"]) . "'>" . utf8_encode($row["categoria"]) . "</option>";
					}
					echo "</select>";

					?>
				</div>

				<div style="width: 100%; float: left;">
					<input type="date" id="dia" name="dia" placeholder="Data" class="input100" />
				</div>

				<div style="width: 100%; float: left;">
					<?php

					$sql = "SELECT * from cartoes";
					$result = mysqli_query($link,$sql);
					echo "<select name='cartao' id='cartao' class='input100'>";
					echo "<option value=''>Sem cartão</option>";
					while ( $row = mysqli_fetch_array($result) ) {
						echo "<option value='" . utf8_encode($row["cartao"]) . "'>Cartão " . utf8_encode($row["cartao"]) . "</option>";
					}
					echo "</select>";

					?>
				</div>

				<div style="width: 100%; float: left;">
					<input type="submit" value="Cadastrar despesa" />
				</div>

			</form>

		</div>





		<!-- ################################################################################################### -->
		<!-- INSERIR CARTÃO -->
		<!-- ################################################################################################### -->

		<div id="despesa-cartao">

			<form id="formulario-despesa-cartao">

				<div style="width: 100%; float: left;">
					<?php

					$sql = "SELECT * from cartoes";
					$result = mysqli_query($link,$sql);
					echo "<select name='cartao_dc' id='cartao_dc'>";
					echo "<option value=''>Selecione cartão</option>";
					while ( $row = mysqli_fetch_array($result) ) {
						echo "<option value='" . utf8_encode($row["cartao"]) . "'> " . utf8_encode($row["cartao"]) . "</option>";
					}
					echo "</select>";

					?>
				</div>

				<div style="width: 58%; float: left;">
					<input type="text" id="descricao_dc" name="descricao_dc" placeholder="Descrição" />
				</div>

				<div style="width: 40%; float: left; margin: 0 0 0 2%;">
					<input type="number" step="0.01" min="0" id="valor_dc" name="valor_dc" placeholder="Valor total" />
				</div>





				<div style="width: 100%; float: left; color: #ccc; margin: 15px 0 15px 0; text-align: center;">
					Detalhamento
				</div>

				<div style="width: 100%; float: left; margin: 0 0 20px 0;" id="item_1">

					<div style="width: 100%; float: left; position: relative;">
						<input type="text" id="descricao_dc1" name="descricao_dc1" class="cartao-item" placeholder="Descrição" />
						<span class="numero">1</span>
					</div>

					<div style="width: 30%; float: left;">
						<input type="number" step="0.01" min="0" id="valor_dc1" name="valor_dc1" placeholder="Valor" />
					</div>

					<div style="width: 68%; float: left; margin: 0 0 0 2%;">
						<?php

						$sql = "SELECT * from despesas ORDER BY categoria";
						$result = mysqli_query($link,$sql);
						echo "<select name='categoria_dc1'>";
						echo "<option value=''>Selecione categoria</option>";
						while ( $row = mysqli_fetch_array($result) ) {
							echo "<option value='" . utf8_encode($row["categoria"]) . "'>" . utf8_encode($row["categoria"]) . "</option>";
						}
						echo "</select>";

						?>
					</div>

				</div>





				<div style="width: 100%; float: left; margin: 0 0 15px 0;" id="adicionar-item">
					<a href="#" id="mais">+ adicionar item</a>
				</div>

				<div style="width: 100%; float: left; margin: 0 0 20px 0; text-align: center;">

					Estão sobrando R$ <span id="sobra">100,00</span>.

				</div>





				<div style="width: 100%; float: left;">
					<input type="submit" value="Cadastrar despesas do cartão" />
				</div>

			</form>

		</div>





		<!-- ################################################################################################### -->
		<!-- PESQUISAR -->
		<!-- ################################################################################################### -->

		<div id="pesquisa">

			<form id="formulario-pesquisa">

				<div style="width: 100%; float: left;">
					<input type="text" id="descricao-p" name="descricao_p" placeholder="Descrição" />
				</div>

				<div style="width: 100%; float: left;">
					<select name="tipo_p">
						<option value="dr">Despesa e receita</option>
						<option value="d">Despesa</option>
						<option value="r">Receita</option>
					</select>
				</div>

				<div style="width: 100%; float: left;">
				<?php

					$sql = "SELECT * from despesas ORDER BY categoria";
					$result = mysqli_query($link,$sql);
					echo "<select name='categoria_p'>";
					echo "<option value=''>Categoria</option>";
					while ( $row = mysqli_fetch_array($result) ) {
					    echo "<option value='" . utf8_encode($row["categoria"]) . "'>" . utf8_encode($row["categoria"]) . "</option>";
					}
					echo "</select>";

				?>
				</div>

				<div style="width: 100%; float: left;">
					<select name="periodo_p">
						<option value="7">Últimos 7 dias</option>
						<option value="15">Últimos 15 dias</option>
						<option value="30">Últimos 30 dias</option>
						<option value="60">Últimos 60 dias</option>
						<option value="90">Últimos 90 dias</option>
						<option value="365">Último ano</option>
					</select>
				</div>

				<div style="width: 49%; float: left;">
					<input type="date" id="dia1" name="dia1" />
				</div>

				<div style="width: 49%; float: left; margin: 0 0 0 2%;">
					<input type="date" id="dia2" name="dia2" />
				</div>

				<div style="width: 100%; float: left;">
					<input type="submit" value="Buscar" />
				</div>

			</form>

			<div id="resultado"></div>

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
			// INPUT VALOR CARTÃO
			// ------------------------------------------------------------------------------------------------

			$('#valor_dc').on('input', function() {

				var Numero = $('#valor_dc').val();
				/*var Ultimo = Numero.substr(Numero.length-1);

				if( Numero=="" || Ultimo==".")
				{
					$("#detalhamento").hide();
				}
				else
				{
					$("#detalhamento").show();
				}*/

				$("#sobra").html(accounting.formatMoney(Numero, "", 2, ".", ","));

			});



			// ------------------------------------------------------------------------------------------------
			// INPUT VALOR CARTÃO
			// ------------------------------------------------------------------------------------------------

			var c = 1;
			var cloned;

			$('#mais').click(function() {

				cloned = $( "#item_"+c );
				$("#item_"+c).clone().attr("id","item_"+(++c)).insertAfter(cloned);
				$("#item_"+c).html($("#item_"+c).html());

				$("#item_"+c+" .numero").html(c);


			});



			// ------------------------------------------------------------------------------------------------
			// MENU
			// ------------------------------------------------------------------------------------------------

			var Ativo = "";

			$("ul li").click(function(){

				$("#mn-"+Ativo).removeClass("ativo");
				$("#"+Ativo).hide();
				var Indice = $(this).attr("id").split("mn-").join("");
				Ativo = Indice;
				$("#"+Ativo).show();
				$("#mn-"+Ativo).addClass("ativo");

			});



			// ------------------------------------------------------------------------------------------------
			// CARTÃO DETALHE
			// ------------------------------------------------------------------------------------------------

			$("#cartao").change(function(){

				if( $(this).val()!=0 )
				{
					$('#cartao-detalhe').show();
				}
				else
				{
					$('#cartao-detalhe').hide();
				}

			});



			// ------------------------------------------------------------------------------------------------
			// 
			// ------------------------------------------------------------------------------------------------

			$("table a").click(function(){

				alert("teste");

			});



			// ------------------------------------------------------------------------------------------------
			// CARTÃO LISTA
			// ------------------------------------------------------------------------------------------------

			$("#cartao-detalhe a").click(function(){

				$('#cartao-lista').show();

			});

			function Teste()
			{
				alert("teste");
			}



			// ------------------------------------------------------------------------------------------------
			// DATA INICIAL
			// ------------------------------------------------------------------------------------------------

			var PegaHoje;
			var Hoje;

			function SetaHoje() {
				PegaHoje = new Date();
				Hoje = (PegaHoje.getFullYear())+"-"+(PegaHoje.getMonth()+1)+"-"+(PegaHoje.getDate());
				return Hoje;
			}

			$("#dia, #dia_r").val(SetaHoje);



			// ------------------------------------------------------------------------------------------------
			// NÃO EXIBE MENSAGENS NO HTML
			// ------------------------------------------------------------------------------------------------

			$.validator.messages.required = '';
			$.validator.messages.number = '';
			$.validator.addMethod("selecione", function(value){ return (value != "0"); }, "");
			$.validator.addMethod("numerovirgula", function (value, element) { return this.optional(element) || /^(\d+|\d+,\d{1,2})$/.test(value); }, "");



			// ------------------------------------------------------------------------------------------------
			// SUBMETE RECEITA
			// ------------------------------------------------------------------------------------------------

			var Descricao;
			var Valor;

			$("#formulario-receita").validate({

				rules: {
					dia_r: { required: true },
					descricao_r: { required: true },
					valor_r: { required: true },
					categoria_r: { selecione: true }
				},

				highlight: function(element){ $(element).addClass('erro'); },
				unhighlight: function(element){ $(element).removeClass('erro'); },

				submitHandler: function(form){
					$("#aguarde").fadeIn();
					$.ajax({
						url: 'cadastrar-receita.php',
						type:'POST',
						data: $(form).serialize(),
						success: function(){

							Descricao = $("#descricao_r").val();
							Valor = accounting.formatMoney($("#valor_r").val(), "R$ ", 2, ".", ",");
							$("#sucesso p").html(Descricao+"<br>"+Valor+"<br><br>Receita cadastrada!");
							$("#formulario-receita").trigger("reset");
							$("#dia_r").val(SetaHoje);
							$("#aguarde").hide();
							$("#sucesso").fadeIn();
							$("#sucesso").delay(4000).fadeOut();

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



			// ------------------------------------------------------------------------------------------------
			// SUBMETE DESPESAS
			// ------------------------------------------------------------------------------------------------

			$("#formulario-despesa").validate({

				rules: {
					dia: { required: true },
					descricao: { required: true },
					valor: { required: true },
					categoria: { selecione: true }
				},

				highlight: function(element){ $(element).addClass('erro'); },
				unhighlight: function(element){ $(element).removeClass('erro'); },

				submitHandler: function(form){
					$.ajax({
						url: 'cadastrar-despesa.php',
						type:'POST',
						data: $(form).serialize(),
						success: function(){

							Descricao = $("#descricao").val();
							Valor = accounting.formatMoney($("#valor").val(), "R$ ", 2, ".", ",");
							$("#sucesso p").html(Descricao+"<br>"+Valor+"<br><br>Despesa cadastrada!");
							$("#formulario-despesa").trigger("reset");
							$("#dia").val(SetaHoje);
							$("#sucesso").fadeIn();
							$("#sucesso").delay(2000).fadeOut();

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



			// ------------------------------------------------------------------------------------------------
			// SUBMETE DESPESAS CARTÃO
			// ------------------------------------------------------------------------------------------------

			$("#formulario-despesa-cartao").validate({

				rules: {
					cartao_dc: { selecione: true },
					descricao_dc: { required: true },
					valor_dc: { required: true },
					valor_dc1: { required: true },
					descricao_dc1: { required: true },
					categoria_dc1: { selecione: true }
				},

				highlight: function(element){ $(element).addClass('erro'); },
				unhighlight: function(element){ $(element).removeClass('erro'); },

				submitHandler: function(form){
					$.ajax({
						url: 'cadastrar-despesa-cartao.php',
						type:'POST',
						data: $(form).serialize(),
						success: function(){

							// Descricao = $("#descricao").val();
							// Valor = accounting.formatMoney($("#valor").val(), "R$ ", 2, ".", ",");
							// $("#sucesso p").html(Descricao+"<br>"+Valor+"<br><br>Despesa cadastrada!");
							// $("#formulario-despesa").trigger("reset");
							// $("#dia").val(SetaHoje);
							// $("#sucesso").fadeIn();
							// $("#sucesso").delay(2000).fadeOut();

						},
						error:function(){

							// $("#erro p").html("Ops!");
							// $("#aguarde").hide();
							// $("#erro").fadeIn();
							// $("#erro").delay(2000).fadeOut();

						}
					});
					return false;
				}

			});



			// ------------------------------------------------------------------------------------------------
			// SUBMETE FORMULÁRIO
			// ------------------------------------------------------------------------------------------------

			$("#formulario-pesquisa").validate({

				submitHandler: function(form){
					$.ajax({
						url: 'pesquisar.php',
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