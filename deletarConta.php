<?php
session_start();

// verifca se o usuário ta logado
if (isset($_SESSION['usuario_id'])) {
    
    
    $id_usuario = $_SESSION['usuario_id'];
    $nome_usuario = $_SESSION['usuario_nome'];
    
   
    $_SESSION = array();
    
    // destroi a sessão
    session_destroy();
}

//redireciona
header("Location: index.php");
exit();
?>