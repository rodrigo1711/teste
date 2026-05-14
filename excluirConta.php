<?php
session_start();

// verifica se o usuário ta logado
if (isset($_SESSION['usuario_id'])) {
    
   
    
    $servername = "localhost";        
    $username = "root";              
    $password = "";                  
    $dbname = "clientes";            
    
    // cria a conexao usando a extesao MySQLi
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // verifdica se houve erro na conexao
    if ($conn->connect_error) {
        error_log("Falha na Conexão com o Banco de Dados: " . $conn->connect_error);
        $_SESSION['erro_bd'] = "Erro de conexão: Não foi possível acessar os dados para exclusão.";
        header("Location: index.php");
        exit();
    }
    
    //exclusao
    $id_usuario = $_SESSION['usuario_id'];
    
   
    $stmt = $conn->prepare("DELETE FROM cadastro WHERE id = ?");
    
    // 'i' indica que o id eh um inteiro
    $stmt->bind_param("i", $id_usuario); 
    
    if ($stmt->execute()) {
        // exclusao feita c suecesso
        
        // destroi a sessao
        $_SESSION['conta_excluida_sucesso'] = true; 
        $_SESSION = array();
        session_destroy();
        
    } else {
        // se a exclusao falhar no bando de dados
        error_log("Erro ao executar DELETE no BD para ID: $id_usuario. Erro: " . $stmt->error);
        $_SESSION['conta_excluida_falha'] = true;
        $_SESSION = array();
        session_destroy();
    }
    
    // fecha o statement e a conexão com o BD
    $stmt->close();
    $conn->close();

} else {
    // se o usuário n estava logado
    $_SESSION = array();
    session_destroy();
}

// redireciona
header("Location: index.php");
exit();
?>