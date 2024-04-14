
<?php
$host = '';
$db   = 'db_teste';
$user = 'root'; // padrão do XAMPP
$pass = '';     // padrão do XAMPP

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
        
        // Redirecionar para a página de login após 3 segundos
        header("Location: http://localhost/projetos/login.html");
        exit(); // Encerra o script após o redirecionamento
 
	} else {
    // Redirecionar para o formulário de cadastro
    header("Location: register-form.html");
    exit();
	}


    $stmt->close();
    $conn->close();
}
?>
