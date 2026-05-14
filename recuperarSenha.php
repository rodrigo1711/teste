<?php
include("conexao.php");

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    
    //primeioro bbusca o usuário pelo email
    $sql = "SELECT id FROM cadastro WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        // usuario encontrado
        $usuario = $resultado->fetch_assoc();
        $user_id = $usuario['id'];

        // segundo simulação de criação de token e redirecionamento
    
        
        $conn->close();
        
        // rredireciona p página onde o usuário define a nova senha
        header("Location: definirNovaSenha.php?id=" . $user_id);
        exit();

    } else {
        $erro = "E-mail não encontrado em nossos registros.";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recuperarSenha.css">
    <title>Recuperar senha - Unbound Place</title>
</head>
<body>
    <header>
        <div class="container-logo"><a href="index.html"></a></div>
    </header>

    <div class="container">
        <?php if (!empty($erro)): ?>
            <p style="color: red; font-weight: bold;"><?php echo $erro; ?></p>
        <?php endif; ?>
        
       <form class="recuperarSenha" action="recuperarSenha.php" method="POST">
            <h1>Recuperar Senha</h1>
            <p>Digite seu e-mail para **redefinir sua senha**.</p>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Enviar</button>
        </form>

        <a href="login.php" class="voltar-link">Voltar para o login</a>
        
    </div>
</body>
</html>