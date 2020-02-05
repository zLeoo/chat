<?php 

require_once 'valida_cadastro.php';

$dado = $bd->listarMensagens();

$apelido = $_SESSION['apelido'];


//echo $apelido;

foreach ($dado as $value) {
	
	if ($apelido == $value['remetente']) {
		$msg = "<div class='chat self'><div class='user-photo'></div><p class='chat-message'><strong class='msg-nick'>".$value['remetente']."</strong>".$value['mensagem']."</p></div>";
	}else{
		$msg = "<div class='chat friend'><div class='user-photo'></div><p class='chat-message'><strong class='msg-nick'>".$value['remetente']."</strong>".$value['mensagem']."</p></div>";
	}
	echo $msg ;
		/*		<p class='chat-message'><strong class='msg-nick'>"."<?php echo". $value['remetente']."?></strong>"."<?php echo ". $value['mensagem']."</p>
*/
		/*" 
  	<div class='chat self'>
		<div class='user-photo'></div>
		<p class='chat-message'><strong class='msg-nick'>"."<?=".$value['remetente']."?></strong>"."<?=".$value['mensagem']."</p>
	</div>"*/

	/*" 
  	<div class='chat self'>
		<div class='user-photo'></div>
		<p class='chat-message'><strong class='msg-nick'>NIck</strong>Meeensagens</p>
	</div>"*/
}



 ?>
