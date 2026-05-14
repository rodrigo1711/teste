<?php
// Inicio da sessão
session_start();

// Verifica se o usuário está logado
$usuario_logado = isset($_SESSION['usuario_id']);
$nome_usuario = $usuario_logado ? $_SESSION['usuario_nome'] : '';

// Conecta ao banco de dados
include 'conexao.php';

// Variáveis para armazenar dados
$total_usuarios = 0;
$dados_erro = null;

try {
    // Query para contar total de usuários cadastrados
    $sql_usuarios = "SELECT COUNT(*) as total FROM cadastro";
    $result_usuarios = $conn->query($sql_usuarios);
    
    if ($result_usuarios) {
        $row = $result_usuarios->fetch_assoc();
        $total_usuarios = $row['total'];
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
    <title>Dashboard Cliente - Unbound Place</title>
</head>

<body>
    <header>
        <div class="logo">
            <h1>Unbound Place</h1>
        </div>
        <div class="menu-container">
            <div class="menu">
                <button class="botao">Categorias</button>
                <div class="categorias">
                    <a href="#">Eletrônicos</a>
                    <a href="#">Roupas</a>
                    <a href="#">Livros</a>
                </div>
            </div>
            <div class="menu">
                <button class="botao">Ordenar</button>
                <div class="categorias">
                    <a href="#">Mais barato</a>
                    <a href="#">Mais caro</a>
                </div>
            </div>

            <div class="menu">
                <button class="botao">Sobre</button>
                <div class="categorias">
                    <a href="#">teste1</a>
                    <a href="#">teste2</a>
                    <a href="#">teste3</a>
                    <a href="#">teste4</a>
                </div>
            </div>
            <div class="menu">
                <button class="botao">dashboards</button>
                <div class="categorias">
                    <a href="dashboard.php">Diretoria</a>
                    <a href="dashboard-cliente.php">Cliente</a>
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
            <h1>Dashboard - Cliente</h1>
            <p>Sua visão geral de atividades</p>
        </div>

        <?php if ($dados_erro): ?>
            <div class="erro-mensagem">
                <p><?php echo htmlspecialchars($dados_erro); ?></p>
            </div>
        <?php endif; ?>

        <?php if (!$usuario_logado): ?>
            <div class="erro-mensagem" style="background-color: #fff3cd; color: #856404; border-color: #ffeaa7;">
                <p>⚠️ Você não está logado. <a href="login.php" style="color: #0056b3;">Faça login para acessar seu dashboard pessoal</a></p>
            </div>
        <?php endif; ?>

        <div class="dashboard-grid">
            <!-- Card 1: Informações do Cliente -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Meu Perfil</h3>
                    <span class="card-icon">👤</span>
                </div>
                <div class="card-body">
                    <p class="card-numero">
                        <?php echo $usuario_logado ? htmlspecialchars($nome_usuario) : 'Não logado'; ?>
                    </p>
                    <p class="card-descricao">
                        <?php echo $usuario_logado ? 'Usuário ativo' : 'Faça login para continuar'; ?>
                    </p>
                </div>
            </div>

            <!-- Card 2: Total de Usuários Ativos -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Comunidade</h3>
                    <span class="card-icon">👥</span>
                </div>
                <div class="card-body">
                    <p class="card-numero"><?php echo $total_usuarios; ?></p>
                    <p class="card-descricao">Usuários na plataforma</p>
                </div>
            </div>

            <!-- Card 3: Histórico -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Meu Histórico</h3>
                    <span class="card-icon">📜</span>
                </div>
                <div class="card-body">
                    <p class="card-numero">0</p>
                    <p class="card-descricao">Compras realizadas</p>
                </div>
            </div>

            <!-- Card 4: Pontos / Recompensas -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3>Pontos</h3>
                    <span class="card-icon">⭐</span>
                </div>
                <div class="card-body">
                    <p class="card-numero">0</p>
                    <p class="card-descricao">Pontos acumulados</p>
                </div>
            </div>
        </div>

        <!-- Seção para Atividades -->
        <div class="dashboard-section">
            <h2>Atividades Recentes</h2>
            <p class="section-info">Sua atividade e interações na plataforma serão exibidas aqui.</p>
            <div class="form-placeholder">
                <p>📋 Nenhuma atividade registrada ainda</p>
            </div>
        </div>

        <!-- Seção para dados customizados futuros -->
        <div class="dashboard-section" style="margin-top: 20px;">
            <h2>Formulário de Dados</h2>
            <p class="section-info">Envie suas informações e dados adicionais para análise personalizada.</p>
            <div class="form-placeholder">
                <p>📝 Espaço reservado para formulário de entrada de dados customizados</p>
            </div>
        </div>
    </main>

    <footer style="text-align: center; padding: 20px; margin-top: 50px; border-top: 1px solid #eee; background-color: #f5f5f5;">
        <p>&copy; 2025 Unbound Place. Todos os direitos reservados.</p>
    </footer>

    <script src="cabecalho.js"></script>
</body>

</html>
