<?php
// inicio do codigo php da sessao
session_start();


// verifica se o ID do usuário esta setado na sessao
$usuario_logado = isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id']);

// caso estiver logado pegamos o nome p exibir, caso contrário eh vazio
$nome_usuario = ($usuario_logado && isset($_SESSION['usuario_nome'])) ? trim($_SESSION['usuario_nome']) : '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Unbound Place</title>
    <style>
        /* --- css vitrine simulacao --- */
        .filtro-container {
            text-align: center;
            margin: 30px 0 10px;
        }

        /* css do filtrozinho*/
        select {
            padding: 10px;
            font-size: 1rem;
            border-radius: 6px;
            border: 1px solid #ffffff;
            cursor: pointer;
        }

        #produtos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .produto-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            transition: transform 0.2s ease;
        }

        .produto-card img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .produto-card p {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .produto-card strong {
            color: #333;
            font-size: 1.1rem;
        }

        /* Novo CSS para exibir o nome e ajustar o menu */
        .dropdown .nome-usuario {
            padding: 5px 15px;
            font-weight: bold;
            color: #333;
            white-space: nowrap;
            /* Impede quebras de linha */
            border-bottom: 1px solid #eee;
            margin-bottom: 5px;
        }
        
        /* --- CSS para lista de compras --- */
        .compras-container {
            max-width: 900px;
            margin: 40px auto 60px;
            padding: 0 20px;
        }

        .compras-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            padding: 24px;
        }

        .compras-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .compras-header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #111;
        }

        .comprar-todos-btn {
            background: #111;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
        }

        .lista-compras {
            display: grid;
            gap: 12px;
        }

        .item-comprado {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #f9f9f9;
            border: 1px solid #e8e8e8;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .item-comprado img {
            width: 64px;
            height: 64px;
            object-fit: contain;
            border-radius: 10px;
            background: #fff;
            border: 1px solid #ddd;
        }

        .item-info {
            flex: 1;
            min-width: 0;
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
        }

        .item-titulo {
            display: block;
            font-weight: 700;
            color: #222;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-preco {
            font-weight: 700;
            color: #111;
            white-space: nowrap;
        }

        .lista-vazia {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        @media (max-width: 768px) {
            .compras-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .item-comprado {
                flex-direction: column;
                align-items: flex-start;
            }
            .item-info {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container-logo"><a href="index.php"></a></div>

        <div class="navegacao">
            <div class="menu">
                <button class="botao"></button>
                <div class="categorias">
                    <a href="#">Mais Vendidos</a>
                    <a href="#">teste2</a>
                    <a href="#">teste3</a>
                    <a href="#">teste4</a>
                </div>
            </div>

            <div class="menu">
                <button class="botao"></button>
                <div class="categorias">
                    <a href="#">Mais barato</a>
                    <a href="#">Mais caro</a>
                </div>
            </div>

            <div class="menu">
                <button class="botao"></button>
                <div class="categorias">
                    <a href="#">documentação</a>
                </div>
            </div>
            
            <?php if ($usuario_logado): ?>
                <div class="menu">
                    <button class="botao">dashboards</button>
                    <div class="categorias">
                        <a href="dashboard.php">Diretoria</a>
                        <a href="dashboard-cliente.php">Cliente</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="perfil">
            <div class="perfil-btn"></div>
            <div class="dropdown">
                <?php if ($usuario_logado): ?>
                    <span class="nome-usuario">Olá, <?php echo htmlspecialchars($nome_usuario); ?></span>
                    <a href="#">Minha Conta</a>
                    <!-- LINK DE EXCLUSAO DE CONTA APONTANDO P CONFIRMACAO -->
                    <a href="confirmarExclusao.php" style="color: red; font-weight: bold;">Excluir Conta</a>
                    <a href="logout.php">Sair</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="crearConta.html">Criar Conta</a>
                <?php endif; ?>
            </div>
        </div>
        <script src="cabecalho.js"></script>
        <link rel="stylesheet" href="cabecalho.css" class="css">
    </header>


    <div class="slider">
        <div class="slides">
            <img src="./IMG/Banner1.PNG.jpeg" class="slide" id="slide1">
            <img src="./IMG/Banner2.PNG.jpeg" class="slide" id="slide2">
            <img src="./IMG/Banner3.PNG.jpeg" class="slide" id="slide3">
        </div>
    </div>

    <div class="categoria">
        <h1>Mais Vendidos</h1>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <?php
        $produtosComprados = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['produtos_comprados_json']) && $usuario_logado) {
            $dados = json_decode($_POST['produtos_comprados_json'], true);
            if (is_array($dados)) {
                $produtosComprados = $dados;
                $_SESSION['produtos_comprados'] = $dados;
            }
        }

        if (empty($produtosComprados)) {
            $produtosComprados = $_SESSION['produtos_comprados'] ?? [];
            if (!is_array($produtosComprados)) {
                $produtosComprados = [];
            }
        }
    ?>

    <div class="compras-container">
        <div class="compras-card">
            <div class="compras-header">
                <h1>Produtos comprados</h1>
            </div>

            <?php if ($usuario_logado): ?>
                <?php if (count($produtosComprados) > 0): ?>
                    <div class="lista-compras">
                        <?php foreach ($produtosComprados as $produto): ?>
                            <div class="item-comprado">
                                <?php if (!empty($produto['image'])): ?>
                                    <img src="<?= htmlspecialchars($produto['image']) ?>" alt="<?= htmlspecialchars($produto['title'] ?? 'Produto') ?>">
                                <?php endif; ?>
                                <div class="item-info">
                                    <span class="item-titulo"><?= htmlspecialchars($produto['title'] ?? 'Produto sem título') ?></span>
                                    <span class="item-preco">R$ <?= number_format((float) ($produto['price'] ?? 0), 2, ',', '.') ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="lista-vazia">Nenhum produto comprado ainda. Seus produtos aparecerão aqui após a compra.</p>
                <?php endif; ?>
            <?php else: ?>
                <p class="lista-vazia">Faça login para ver seus produtos comprados.</p>
            <?php endif; ?>
        </div>
    </div>


    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Unbound Place</h3>
                <ul>
                    <li><a href="#">Novidades</a></li>
                    <li><a href="#">Coleções</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Rastrear Pedido</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Ajuda</h3>
                <ul>
                    <li><a href="#">Dúvidas Frequentes</a></li>
                    <li><a href="#">Trocas e Devoluções</a></li>
                    <li><a href="#">Formas de Pagamento</a></li>
                    <li><a href="#">Fale Conosco</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Institucional</h3>
                <ul>
                    <li><a href="#">Sobre Nós</a></li>
                    <li><a href="#">Sustentabilidade</a></li>
                    <li><a href="#">Política de Privacidade</a></li>
                    <li><a href="#">Termos de Uso</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Redes Sociais</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 Unbound Place. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>