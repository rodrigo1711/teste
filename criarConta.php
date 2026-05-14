<?php
// inclui o arquivo de conexao.php
include("conexao.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // primeiro recebe os dados do formulario
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    // segundo  vverifica a confirmação de senha
    if ($senha != $confSenha) {
        // caso as senhas n sejam as mesma ele aponta o erro
        echo "<h2>❌ Erro: As senhas não coincidem!</h2>";
        echo "<a href='crearConta.html'>Voltar</a>";
        exit;
    } //123 adicionar logica da senha com 6 presente em definirNovaSenha.php

    // terceiro hash (hash eh a criptografia da senha) da Senha 
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO cadastro (nome, email, senha) VALUES (?, ?, ?)";

    // prepara a declaração (prrepared statement)
    $stmt = $conn->prepare($sql);
    
    // "sss" aponta q os tres parametros são strings (s = string)
    // o ultimo "senha_hash" eh a senha criptografada
    $stmt->bind_param("sss", $nome, $email, $senha_hash);

    // quinto Execução
    if ($stmt->execute()) {
        // sexto redirecionamentto  de sucessso
        header("Location: login.html?cadastro=sucesso"); 
        exit(); // garante que o redirecionamento ocorra
    } else {
        // setimo tratamento de erros
        echo "❌ ERRO ao cadastrar! Verifique as colunas da sua tabela.";
        echo "<br>Erro MySQL: " . $stmt->error; // mostra o erro do prrepared sstatement
    }

    $stmt->close();
    $conn->close();
}
?>