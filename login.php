<?php 
// primeiro inicia a sessão (caso nnn tenha feito)
session_start();

// segundo vai verificar se a mensagem de erro foi enviada pelo script de processamento
$erro_display = "";
if (isset($_GET['erro'])) {
    $erro_display = htmlspecialchars(urldecode($_GET['erro']));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>

    <div class="container">
        <!-- aqui eh onde a msg de erro eh exibida -->
        <?php 
        if (!empty($erro_display)) {
            echo "<p style='color: red; font-weight: bold;'>❌ " . $erro_display . "</p>";
        }
        
        // mostra mensagem de sucesso vinda do cadastro
        if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') {
            echo "<p style='color: green; font-weight: bold;'>✅ Cadastro realizado com sucesso! Faça login.</p>";
        }
        ?>

        <form class="login" method="POST" action="login.php">
    


<?php
// primeiro iniciar a sessão
session_start();

// segundo incluir a conexxao
include("conexao.php");

// habilita a exibicao de erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // recebe os dados do formulário
    $email = trim($_POST['email'] ?? '');
    $senha_digitada = trim($_POST['senha'] ?? '');
    
    // terceiroprepara  a consulta no banco de dados
    $sql = "SELECT id, nome, senha FROM cadastro WHERE email = ?";
    
    $stmt = $conn->prepare($sql);
    $erro_processamento = "";

    if (!$stmt) {
        $erro_processamento = "Erro ao preparar a consulta: " . $conn->error;
    } else {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows == 1) {
            
            $usuario = $resultado->fetch_assoc();
            $hash_do_banco = $usuario['senha'];
            
            // quarto ele  verificaa a Senha
            if (password_verify($senha_digitada, $hash_do_banco)) {
                
                // caso tenha sucesso: criar sessao e redirecionar
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                
                header("Location: index.php"); 
                exit(); 
                
            } else {
                // senha ewrrada
                $erro_processamento = "Email ou senha inválidos.";
            }
        } else {
            // usuario  nn encontrado
            $erro_processamento = "Email ou senha inválidos.";
        }

        $stmt->close();
    }
    
    $conn->close();
    
    // se tiver erro de login redireciona de volta p página de login
    // enviando a mensagem de erro via URL query string
    header("Location: login.html?erro=" . urlencode($erro_processamento));
    exit();
} 

// se o arquivo for acessado diretamente get apenas redireciona p página de login
header("Location: login.html");
exit();
?>