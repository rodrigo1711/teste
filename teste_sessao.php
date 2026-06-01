<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: " . gmdate("D, d M Y H:i:s", time() - 3600) . " GMT");

echo "<h1>Teste de Sessão</h1>";
echo "<pre>";
echo "SESSION ID: " . session_id() . "\n\n";
echo "Conteúdo de \$_SESSION:\n";
var_dump($_SESSION);
echo "\n\nUsuário Logado: " . (isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id']) ? "SIM ✅" : "NÃO ❌");
echo "\n\nID: " . ($_SESSION['usuario_id'] ?? 'VAZIO');
echo "\n\nNome: " . ($_SESSION['usuario_nome'] ?? 'VAZIO');
echo "</pre>";

echo "<p><a href='index.php'>Voltar ao Index</a> | <a href='logout.php'>Fazer Logout</a></p>";
?>
