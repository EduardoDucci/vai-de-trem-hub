<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'ferrovia_db');
    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $sql = "SELECT id_funcionario, nome FROM funcionario WHERE nome=? AND cpf=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $_SESSION['usuario'] = $result->fetch_assoc();
        header('Location: dashboard.php');
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
    $stmt->close();
    $conn->close();
}
?>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>login</title>
 </head>

 <body>
   
      <div id='alinhar__texto'>
            <img id='icone' src="../images/icons/icone__principal.png">
           <p id='bem__vindo'>Bem vindo!</p>
      </div>
        <div class='idr'>
            <a href="registrar__se.php">
                <div class="opacity">
                   <button class="button">Registrar-se</button>
                </div>
            </a>
        </div> 
        
       <h4 class="jc">ja tem uma conta?</h4>
       <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
       <form method="POST" action="login.php">
            <div class='id'> 
                <div><input type='text' class="text__box" name='usuario' placeholder="Usuário..." required></div>
            </div>
            <div class='id'>
                <div><input type='password' class="text__box" name='senha' placeholder="Senha..." required></div>
            </div>
            <div class='idl'>
                <div class="opacity">
                   <button class="button">Fazer login</button>
                </div>
            </a>
        </div>
        
        <div class='ide'>
            <img id="icone__google" src="../images/icons/google__icon.png">
            <p>Entrar com Google</p>
        </div>
        
        <div class='ide'>
            <img id="icone__linkedin" src="../images/icons/linkedin__icon.png">
            <p>Entrar com Linkedin</p>
        </div>
        
        <div class='enterprise'>
            <p>Goudard Enterprises</p>
        </div>

 </body>
</html>