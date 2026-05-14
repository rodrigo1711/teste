<?php
// iniciaa a sessao
session_start();

// verifica se o usuário ta logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$nome_usuario = isset($_SESSION['usuario_nome']) ? $_SESSION['usuario_nome'] : 'usuário';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Exclusão de Conta</title>
    
    <!--  a msm fonte que tem no site -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="index.css">
    <style>
        /* aplicacao da fontr poppins na pag toda */
        body {
            font-family: 'Poppins', sans-serif;
        }

    
        .confirmacao-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 20px;
            text-align: center;
        }

        .cartao-aviso {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            border: 2px solid #ff4444; 
        }

        .cartao-aviso h1 {
            color: #ff4444;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .cartao-aviso p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #333;
        }

        .botoes-acao {
            display: flex;
            justify-content: space-around;
            gap: 15px;
        }

        .botoes-acao a, .botoes-acao button {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            text-align: center;
            border: none;
        }

        /* biotao de cancelar */
        .cancelar {
            background-color: #ccc;
            color: #333;
        }

        .cancelar:hover {
            background-color: #bbb;
        }

        /* botao p confirmar exclusap */
        .confirmar-exclusao {
            background-color: #ff4444;
            color: white;
            box-shadow: 0 4px 8px rgba(255, 68, 68, 0.4);
        }

        .confirmar-exclusao:hover {
            background-color: #cc3333;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>
    <div class="confirmacao-container">
        <div class="cartao-aviso">
            <h1>Aviso Importante!</h1>
            <p>
                Olá, <?php echo htmlspecialchars($nome_usuario); ?>! Você está prestes a excluir sua conta na Unbound Place.
                <br><br>
                Esta ação é permanente e irreversível! Todos os seus dados, histórico de pedidos e informações de perfil serão removidos.
                <br><br>
                Tem certeza que deseja continuar?
            </p>
            <div class="botoes-acao">
                <a href="index.php" class="cancelar">Cancelar</a>
                <a href="excluirConta.php" class="confirmar-exclusao">Sim, desejo excluir minha conta!</a>
            </div>
        </div>
    </div>
</body>

</html>