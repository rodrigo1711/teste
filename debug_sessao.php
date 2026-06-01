<?php
session_start();

// Previne cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: " . gmdate("D, d M Y H:i:s", time() - 3600) . " GMT");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Debug - Sessão</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 { color: #333; }
        pre {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
            border: 1px solid #ddd;
        }
        .status {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            font-weight: bold;
        }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 DEBUG - Verificação de Sessão</h1>
        
        <?php if (isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id'])): ?>
            <div class="status success">✅ SESSÃO ATIVA!</div>
            <pre>
ID do Usuário: <?php echo htmlspecialchars($_SESSION['usuario_id']); ?>

Nome do Usuário: <?php echo htmlspecialchars($_SESSION['usuario_nome'] ?? 'NÃO DEFINIDO'); ?>

Session ID: <?php echo session_id(); ?>

Cookies: <?php var_dump($_COOKIE); ?>
            </pre>
        <?php else: ?>
            <div class="status error">❌ SESSÃO NÃO ENCONTRADA</div>
            <p>Você precisa fazer <strong>login</strong> primeiro.</p>
            <pre>
Session Data: <?php var_dump($_SESSION); ?>
            </pre>
        <?php endif; ?>

        <a href="index.php">← Voltar ao Index</a>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            | <a href="logout.php">Fazer Logout</a>
        <?php endif; ?>
    </div>
</body>
</html>
