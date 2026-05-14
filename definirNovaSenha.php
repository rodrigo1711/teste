<?php
include("conexao.php");

$erro = "";
$sucesso = "";
$user_id = $_GET['id'] ?? null; // pega a id da url

// primeiro verifica se a id tá presente
if (!$user_id || !is_numeric($user_id)) {
    $erro = "Link de redefinição inválido ou expirado. Por favor, comece o processo novamente.";
}

// segyundo processa o formulário de nova senha
if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id) {
    

    
    $nova_senha = trim($_POST['nova_senha'] ?? '');
    $conf_senha = trim($_POST['conf_senha'] ?? '');
    
    if ($nova_senha != $conf_senha) {
        $erro = "As senhas não coincidem.";
    } elseif (strlen($nova_senha) < 6) { 
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        // terceiro hasheia a nova senha
        $novo_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        
        // quarto da update no banco
        $sql_update = "UPDATE cadastro SET senha = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("si", $novo_hash, $user_id);
        
        if ($stmt_update->execute()) {
            $sucesso = "✅ Sua senha foi redefinida com sucesso! Você pode fazer login agora.";
            $user_id = null; // impede que o formulário apareça após o sucesso
        } else {
            $erro = "Erro ao atualizar a senha: " . $conn->error;
        }
        $stmt_update->close();
    }
}

if (isset($conn) && $conn instanceof mysqli) {
    
    @$conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="recuperarSenha.css"> 
    <title>Definir Nova Senha - Unbound Place</title>
</head>
<body>
    <header>
       
        <div class="container-logo"><a href="index.php"></a></div>
    </header>

    
    <div class="container">
        
        <!-- exibicao de mensagem de status suceso ou erro -->
        <?php 
        if ($sucesso) {
            echo "<p style='color: green; font-weight: bold; text-align: center;'>$sucesso</p>";
        } elseif ($erro) {
    
            echo "<p style='color: #B4FF00; background-color: #111; padding: 10px; border-radius: 5px; text-align: center;'>❌ $erro</p>";
        }
        
        // mostra o formulário APENAS se NAO tiver sucesso e a id for valida
        if (!$sucesso && $user_id): 
        ?>
        
        <form class="login" action="definirNovaSenha.php?id=<?php echo htmlspecialchars($user_id); ?>" method="POST">
            <h1>Definir Nova Senha</h1>
            <p>Digite e confirme a sua nova senha.</p>
            
        
            <input type="password" name="nova_senha" placeholder="Nova Senha" required>
            <input type="password" name="conf_senha" placeholder="Confirme a Nova Senha" required>
            
            <button type="submit">Redefinir Senha</button>
        </form>
        
        <?php endif; ?>
        
     
        <div class="criar">
            <a href="login.php" class="voltar-link">Voltar para o Login</a>
        </div>
        
    </div>
</body>
</html>