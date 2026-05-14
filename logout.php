<?php
// primeiro inicia a sessão
session_start();

// segundo acaba todos os dados da sessao
// limpa o array $_SESSION
$_SESSION = array(); 

// acaha completamente o cookie de sessao do navegador se existir 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// terceioro finalmente destroi a sessão
session_destroy();

// quarto redireciona o usuário p página inicial (index.php)
header("Location: index.php?status=logout");
exit;
?>