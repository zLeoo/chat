<?php 

  session_start();
  error_reporting(0);
/*class Usuario{

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}

}*/
class Conexao {
	private $host = 'localhost';
	private $dbname = 'chat_pessoal';
	private $user = 'root';
	private $pass = '';

	public function conectar() {
		try {
			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"
			);

			$conexao->exec('set charset set utf8');

			return $conexao;  

		}catch (PDOException $e) {
			echo "<p>".$e->getMessage()."</p>";
	}
}
}


class Bd{
	public function __construct(Conexao $conexao){
		$this->conexao = $conexao->conectar();		
	}

	public function cadastrar($email, $senha, $apelido) {
		$query = '
			select id_usuario from tb_usuarios where email = :e';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':e', $email);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			echo "<div class='text-danger'>Usuario ja cadastrado</div>";

		}else {
			$query = '
			insert into tb_usuarios(email, senha, apelido) values (:e, :s, :a) ';

			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':e', $email);
			$stmt->bindValue(':s', $senha);
			$stmt->bindValue(':a', $apelido);
			$stmt->execute();


		}


	}

	public function logar($email, $senha){
		$query = '
			select id_usuario, apelido from tb_usuarios where email = :e and senha = :s';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':e', $email);
		$stmt->bindValue(':s', $senha);
		$stmt->execute();	

		if ($stmt->rowCount() > 0) {
			$dado = $stmt->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			$_SESSION['apelido'] = $dado['apelido'];
			$_SESSION['estado'] = 'autenticado';
			header('Location: chat.php');
			//print_r($_SESSION);
			//print_r($dado);
		}else{
			echo "email ou senha incorretos";
			return false;
		}

	}

	public function adicionarMensagem($mensagem, $remetente){
		$query = '
			insert into tb_mensagens(remetente,mensagem) values (:remetente,:msg)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':msg', $mensagem);
		$stmt->bindValue(':remetente', $remetente);
		
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			echo $mensagem;
		}

	}

	public function listarMensagens(){
		$query = '
			select remetente,mensagem from tb_mensagens order by id_mensagem asc';
		$stmt = $this->conexao->prepare($query);
		//SELECT mensagem FROM `tb_mensagens` ORDER by id_mensagem DESC
		$stmt->execute();	
		$dado = $stmt->fetchall();
		return $dado;
		
		

	}
	

}

$conexao = new Conexao();

$bd = new Bd($conexao);

//$requisicao = $_GET['modo'];
//$mensagem = $_GET['mensagem'];
//$remetente = $_GET['remetente'];


if(isset($_GET['modo']) || $_GET['modo'] == 'requisicao'){
	$bd->adicionarMensagem($_GET['mensagem'], $_GET['remetente']);
	
}

//$acao = $_GET['acao'];
//print_r($acao);


?>