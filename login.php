
<?php
$host = 'localhost';
$db   = 'db_teste';
$user = 'root'; // padrão do XAMPP
$pass = '';     // padrão do XAMPP

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($senha, $user['senha'])) {
        // Login bem-sucedido
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['nome'] = $user['nome'];
        header("Location: home.html");
        exit();
    } else {
        echo "Email ou senha incorretos.";
    }

    $stmt->close();
    $conn->close();
}
?>
