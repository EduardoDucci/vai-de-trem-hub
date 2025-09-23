<?php
session_start();

$conn = new mysqli('localhost', 'root', 'root', 'ferrovia_db');
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $numero = $_POST['numero'] ?? '';

    if (!empty($email) && !empty($usuario) && !empty($senha) && !empty($numero)) {
        $sql_check = "SELECT id_usuarios FROM usuarios WHERE usuario=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $usuario);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            echo "<script>alert('Usuário já existe!');</script>";
        } else {
            $sql = "INSERT INTO usuarios (email, usuario, senha, numero) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $email, $usuario, $senha, $numero);
            if ($stmt->execute()) {
                echo "<script>alert('Registro realizado com sucesso!'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Erro ao registrar!');</script>";
            }
            $stmt->close();
        }
        $stmt_check->close();
    }
    elseif (!empty($usuario) && !empty($senha)) {
        $sql = "SELECT id_usuarios, usuario FROM usuarios WHERE usuario=? AND senha=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $_SESSION['usuario'] = $result->fetch_assoc();
            header('Location: dashboard.php');
            exit;
        } else {
            echo "<script>alert('Usuário ou senha inválidos.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
$conn->close();
?>