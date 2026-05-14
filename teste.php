<?php
$conn = new mysqli("localhost", "root", "", "clientes");
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
echo "Conexão OK!";
?>