<?php  

require_once 'valida_cadastro.php';


?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Chat</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
    </style>
  </head>
<body>
   <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">
        <img src="logo.png" width="35" height="35" class="d-inline-block align-top" alt=""> 
        Chat Pessoal
      </a>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Nova Conta
            </div>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <input name="apelido" type="text" class="form-control" placeholder="Apelido">
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha">
                </div>

                <button class="btn btn-lg btn-info btn-block" type="submit">Cadastrar</button>
                <?php  

                  if (isset($_POST['email'])) {
                   
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $apelido = $_POST['apelido'];

                    if (empty($email) || empty($senha) ) {?>                     
                        <div class="text-danger">
                          Usuário ou senha inválido(s)
                        </div>
                    <?}else{
                      $bd->cadastrar($email, $senha, $apelido);
                    }
                  }




                  ?>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>






</body>


</html>