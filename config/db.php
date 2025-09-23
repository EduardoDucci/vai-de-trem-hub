<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', 'root', 'ferrovia_db');
    if ($conn->connect_error) {
        die('Erro de conexão: ' . $conn->connect_error);
    }
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
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
        $erro = "Usuário ou senha inválidos.";
    }
    $stmt->close();
    $conn->close();
}
?>