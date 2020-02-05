<?php  

	require_once 'valida_cadastro.php';
  
  if (!isset($_SESSION['id_usuario'])) {
    header('Location: index.php?erro1');
  }
  $apelido = $_SESSION['apelido'];
  //echo $apelido;

  //echo "Bem Vindo,".$_SESSION['apelido'];
?>
<html>
<head>
	<title>Flat Chat</title>	
	<!-- estilos -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- script -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>


		$(document).ready(() => {

			let contador = 0

			$('#caixa_msg').keyup((e) => {
		
				if(e.keyCode == 13) {
					let txt = $(e.target).val()
					
					$(e.target).val('')
					//requisição
					$.ajax({
						url: 'valida_cadastro.php',
						success: function(result){
							console.log(result)
							//a requisição esta se encaminhando para o php e esta registrando no banco precisamos fazer uma nova requisição para atualizar o html do script chat.php adicionando o novo html de chat o result é a mensagem
							
							
						} ,
						data: {remetente : '<?php echo $apelido?>' , mensagem : txt , modo : 'requisicao'}

					})
				}

				$('#botao').click(() => {
					contador++
					if (contador == 1) {
						let txt = $(e.target).val()
					
						$(e.target).val('')
						//requisição
						$.ajax({
							url: 'valida_cadastro.php',
							success: function(result){
								console.log(result)
								//a requisição esta se encaminhando para o php e esta registrando no banco precisamos fazer uma nova requisição para atualizar o html do script chat.php adicionando o novo html de chat o result é a mensagem
								contador = 0
								
							} ,
							data: {remetente : '<?php echo $apelido?>' , mensagem : txt , modo : 'requisicao'}

						})
					}
					

				})
			})
		})
	</script>
	
	

	

</head>
<body>

	<nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Chat Pessoal
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logoff.php">SAIR</a>
        </li>
      </ul>
    </nav>

	<div class="chatbox">

		<div class="chatlogs">
			
			<script>
				
				setInterval(myFunction, 2000);
				
				
				function myFunction(){
					$.get('mensagens.php', function(result){
						
						$('.chatlogs').html(result);
					})
				}


			</script>			

		</div>

		
		
		<div class="chat-form">
			<textarea id="caixa_msg" ></textarea>
			<button id="botao">Enviar</button>
		</div>
		
	</div>



</body>
</html>