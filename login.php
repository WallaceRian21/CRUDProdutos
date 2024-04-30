<?php
include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4. The starter version of Gradient Able is completely free for personal project." />
  <meta name="keywords" content="free dashboard template, free admin, free bootstrap template, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
  <meta name="author" content="codedthemes">
  <link rel="icon" href="assets/images/caminhao-bau.png" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <title>Reg Transportes</title>
</head>
<style>

    body {
         background-image: url('img/img_logistica.jpg');
         background-repeat: no-repeat;
         /* Define a posição da imagem. Pode ser 'left top', 'center center', 'right bottom', etc. */
         background-position: center center;
        /* Define como a imagem é exibida. Pode ser 'cover' para cobrir todo o elemento ou 'contain' para caber dentro dele. */
        background-size: cover;
        /* Garante que a imagem não se repita além do necessário, mesmo que a tela seja maior que a imagem. */
        background-attachment: fixed;
        /* Adiciona um degradê de cor sobre a imagem, ajustando a opacidade conforme necessário. */
        background: linear-gradient(rgba(255,255,255,0.5), rgba(255,255,255,0.5)), url('img/img_logistica.jpg');
    }

</style>

<body class="bg-light">

<div class="container-fluid">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-primary text-white text-center">
          <h3 class="mb-0">Login</h3>
        </div>
        <div class="card-body">
          <form class="md-float-material" action="" method="post">
            <div class="mb-3">
              <label for="usuario" class="form-label">Usuário:</label>
              <input type="text" class="form-control" name="usuario" id="usuario" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario']; } ?>" placeholder="Digite seu usuário">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Senha:</label>
              <input type="password" name="senha_usuario" class="form-control" id="senha_usuario" value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"  placeholder="Digite sua senha">
            </div>
            <?php
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                           
                if (!empty($dados['SendLogin'])) {
                    $query_usuario = "SELECT id, nome, usuario, senha_usuario 
                    FROM usuarios 
                    WHERE usuario =:usuario  
                    LIMIT 1";
                    $result_usuario = $conn->prepare($query_usuario);
                    $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
                    $result_usuario->execute();

                    if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
                        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                        if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                            $_SESSION['id'] = $row_usuario['id'];
                            $_SESSION['nome'] = $row_usuario['nome'];
                            
                            header("Location: viagens.php");
                        }else{
                            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
                        }
                    }else{
                        $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválida!</p>";
                    }
                }

                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }

            ?>
            <button type="submit" value="Acessar" name="SendLogin" class="btn btn-md text-center btn-primary btn-block ">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'view/final_form.php'; ?>
