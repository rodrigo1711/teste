<?php
// Inicio da sessão
session_start();

// Verifica se o usuário está logado
$usuario_logado = isset($_SESSION['usuario_id']);
$nome_usuario = $usuario_logado ? $_SESSION['usuario_nome'] : '';

// Conecta ao banco de dados
include 'conexao.php';

// Variáveis para armazenar dados do dashboard
$total_usuarios = 0;
$total_logins = 0;
$dados_erro = null;

try {
    // Query para contar total de usuários cadastrados
    $sql_usuarios = "SELECT COUNT(*) as total FROM cadastro";
    $result_usuarios = $conn->query($sql_usuarios);
    
    if ($result_usuarios) {
        $row = $result_usuarios->fetch_assoc();
        $total_usuarios = $row['total'];
    }
    
    // Query para contar total de registros na tabela login (representa acessos/logins)
    $sql_logins = "SELECT COUNT(*) as total FROM login";
    $result_logins = $conn->query($sql_logins);
    
    if ($result_logins) {
        $row = $result_logins->fetch_assoc();
        $total_logins = $row['total'];
    }
    
} catch (Exception $e) {
    $dados_erro = "Erro ao carregar dados: " . $e->getMessage();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="cabecalho.css">
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard - Unbound Place</title>
</head>

<body>
    <header>
        <div c lass="container-logo"><a href="index.php">
            <h1>Unbound Place</h1>
        </div>
        <div class="menu-container">
                </div>
            </div>

            <div class="menu">
                </div>
            </div>
            <div class="menu">
                </div>
            </div>
        </div>
        <div class="perfil">
            <div class="perfil-btn"></div>
            <div class="dropdown">
                <?php if ($usuario_logado): ?>
                    <span class="nome-usuario">Olá, <?php echo htmlspecialchars($nome_usuario); ?></span>
                    <a href="#">Minha Conta</a>
                    <a href="confirmarExclusao.php" style="color: red; font-weight: bold;">Excluir Conta</a>
                    <a href="logout.php">Sair</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="crearConta.html">Criar Conta</a>
                <?php endif; ?>
            </div>
        </div>
        <script src="cabecalho.js"></script>
    </header>

    <main class="dashboard-container">
        <div class="dashboard-header">
            <h1>Dashboard - Diretoria</h1>
            <p>Resumo de atividades do site</p>
        </div>

        <?php if ($dados_erro): ?>
            <div class="erro-mensagem">
                <p><?php echo htmlspecialchars($dados_erro); ?></p>
            </div>
        <?php endif; ?>

        <div class="dashboard-grid">
            <!-- Card 1: Total de Usuários -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Total de Usuários</h3>
                    <span class="card-icon">👥</span>
                </div>
                <div class="card-body">
                    <p class="card-numero"><?php echo $total_usuarios; ?></p>
                    <p class="card-descricao">Usuários cadastrados no sistema</p>
                </div>
            </div>

            <!-- Card 2: Total de Logins -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Total de Logins</h3>
                    <span class="card-icon">🔐</span>
                </div>
                <div class="card-body">
                    <p class="card-numero"><?php echo $total_logins; ?></p>
                    <p class="card-descricao">Acessos registrados</p>
                </div>
            </div>

            <!-- Card 3: Taxa de Atividade -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Taxa de Atividade</h3>
                    <span class="card-icon">📊</span>
                </div>
                <div class="card-body">
                    <p class="card-numero">
                        <?php 
                            echo ($total_usuarios > 0) 
                                ? round(($total_logins / $total_usuarios), 2) 
                                : '0'; 
                        ?>
                    </p>
                    <p class="card-descricao">Logins por usuário</p>
                </div>
            </div>

            <!-- Card 4: Status do Sistema -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Status do Sistema</h3>
                    <span class="card-icon">✅</span>
                </div>
                <div class="card-body">
                    <p class="card-numero status-online">Online</p>
                    <p class="card-descricao">Servidor operacional</p>
                </div>
            </div>
        </div>

        <!-- Seção para formulário futuro -->
        <div class="dashboard-section">
            <h2>Adicionar Dados</h2>
            <p class="section-info">Futuramente, um formulário será adicionado aqui para registrar dados customizados e análises detalhadas.</p>
            <div class="form-placeholder">
                <p>📋 Espaço reservado para formulário de entrada de dados</p>
            </div>
        </div>
    </main>

    <footer style="text-align: center; padding: 20px; margin-top: 50px; border-top: 1px solid #eee; background-color: #f5f5f5;">
        <p>&copy; 2025 Unbound Place. Todos os direitos reservados.</p>
    </footer>

    <script src="cabecalho.js"></script>
</body>

</html>
