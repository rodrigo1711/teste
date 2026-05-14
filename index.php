<?php
// inicio do codigo php da sessao
//
session_start();

// verifica se o ID do usuário esta setado na sessao
$usuario_logado = isset($_SESSION['usuario_id']);

// caso estiver logado pegamos o nome p exibir, caso contrário eh vazio
$nome_usuario = $usuario_logado ? $_SESSION['usuario_nome'] : '';
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
        
        /* --- CSS DO MODAL DE DETALHES --- */
        
        .detalhe-modal {
            /* Fundo escuro semi-transparente (o overlay) */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85); /* Fundo bem escuro */
            display: flex; /* Centraliza o conteúdo */
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Garante que fique acima de tudo */
            overflow-y: auto; /* Permite rolar se o conteúdo for grande */
            padding: 20px;
        }

        .detalhe-content {
            /* O cartão branco que contém as informações do produto */
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            max-width: 1000px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);

            /* Layout interno */
            display: flex;
            gap: 60px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            position: relative; /* Para posicionar o botão Voltar absolutamente */
        }

        /* Estilo para o botão Voltar dentro do modal */
        .detalhe-content button#voltar-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #333;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            z-index: 1001;
        }

        .detalhe-content button#voltar-btn:hover {
            background-color: #555;
        }

        /* Responsividade para o modal em telas menores */
        @media (max-width: 768px) {
            .detalhe-content {
                flex-direction: column;
                gap: 30px;
                padding: 20px;
            }

            .detalhe-content img {
                width: 100%;
                height: auto;
                max-width: 300px;
            }

            /* O botão voltar deve ser reposicionado */
            .detalhe-content button#voltar-btn {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 20px;
                align-self: flex-start;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container-logo"><a href="index.php"></a></div>

        <div class="navegacao">
            <div class="menu">
                <button class="botao">Categoria</button>
                <div class="categorias">
                    <a href="#">Mais Vendidos</a>
                    <a href="#">teste2</a>
                    <a href="#">teste3</a>
                    <a href="#">teste4</a>
                </div>
            </div>

            <div class="menu">
                <button class="botao">Filtro</button>
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
            
                
                    <?php if ($usuario_logado): ?>
                <div class="menu"></div>
                <div class="categorias"></div>
                <button class="botao">dashboards</button>
                        <a href="dashboard.php">Diretoria</a>
                    <a href="dashboard-cliente.php">Cliente</a>
                    </div> 
                    <?php else: ?>
                    
                        <?php endif; ?>
                
            
        
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
            <img src="./IMG/Banner2.PNG.jpeg" class="slide" id="slide1">
            <img src="./IMG/Banner3.PNG.jpeg" class="slide" id="slide1">
        </div>
    </div>

    <div class="categoria">
        <h1>Mais Vendidos</h1>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- MODAL DE DETALHES -->
    <div id="detalhe-produto" class="detalhe-modal" style="display:none;">
        <div class="detalhe-content">
            <button id="voltar-btn">Voltar</button>

            <div style="display: flex; gap: 60px; align-items: center; justify-content: center; flex-wrap: wrap; width: 100%; margin-top: 40px;">
                <div style="flex: 1; text-align: center; min-width: 300px; max-width: 45%;">
                    <img id="detalhe-img" src="" alt=""
                        style="width: 350px; height: 350px; object-fit: contain; border-radius: 12px; border: 1px solid #ccc;">
                    <div id="miniaturas"
                        style="margin-top: 15px; display: flex; gap: 10px; justify-content: center;"></div>
                </div>

                <div style="flex: 1; min-width: 280px; max-width: 45%;">
                    <h2 id="detalhe-titulo" style="font-size: 1.6rem; font-weight: 700; margin-bottom: 15px;"></h2>
                    <p id="detalhe-desc" style="font-size: 1rem; line-height: 1.5; margin-bottom: 15px;"></p>
                    <strong id="detalhe-preco"
                        style="display:block; font-size: 1.4rem; margin-bottom: 25px;">
                    </strong>
                    <button id="add-carrinho"
                        style="padding: 12px 28px; background-color: #111; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                        Adicionar ao Carrinho
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="filtro-container">
        <label for="filtro">Ordenar por:</label>

        <select id="filtro">
            <option value="padrao">Padrão</option>
            <option value="menor">Mais barato</option>
            <option value="maior">Mais caro</option>
        </select>
    </div>


    <div id="produtos">Carregando produtos...</div>

    <script>
        let produtos = [];

        function mostrarDetalhes(produto) {
            // Esconde elementos da página principal
            document.getElementById('produtos').style.display = 'none';
            document.getElementById('filtro').style.display = 'none';
            document.querySelector('.filtro-container').style.display = 'none';
            // Oculta a barra de rolagem da página inteira
            document.body.style.overflow = 'hidden';


            const detalhe = document.getElementById('detalhe-produto');
            detalhe.style.display = 'flex'; // Exibe o modal

            document.getElementById('detalhe-img').src = produto.image;
            document.getElementById('detalhe-titulo').textContent = produto.title;

            // 🔹 Aqui você pode editar manualmente as descrições
            let descricaoPersonalizada = "";
            if (produto.id === 1) {
                descricaoPersonalizada = "Camiseta premium slim fit, leve e confortável, ideal para uso casual e esportivo.";
            } else if (produto.id === 2) {
                descricaoPersonalizada = "Camisa básica de algodão com toque suave e caimento moderno.";
            }

            document.getElementById('detalhe-desc').textContent =
                descricaoPersonalizada || produto.description;

            document.getElementById('detalhe-preco').textContent =
                'R$ ' + produto.price.toFixed(2);

            // Miniaturas (exemplo repetido)
            const miniDiv = document.getElementById('miniaturas');
            miniDiv.innerHTML = '';
            for (let i = 0; i < 3; i++) {
                const mini = document.createElement('img');
                mini.src = produto.image;
                mini.style.width = '60px';
                mini.style.height = '60px';
                mini.style.objectFit = 'contain';
                mini.style.border = '1px solid #ccc';
                mini.style.borderRadius = '6px';
                mini.style.cursor = 'pointer';
                mini.onclick = () => document.getElementById('detalhe-img').src = mini.src;
                miniDiv.appendChild(mini);
            }
        }

        function voltarLista() {
            // Esconde o modal
            document.getElementById('detalhe-produto').style.display = 'none';
            // Reexibe elementos da página principal
            document.getElementById('produtos').style.display = 'grid';
            document.getElementById('filtro').style.display = 'inline-block';
            document.querySelector('.filtro-container').style.display = 'block';
            // Restaura a barra de rolagem da página
            document.body.style.overflow = 'auto';
        }

        document.getElementById('voltar-btn').addEventListener('click', voltarLista);


        function renderizar(lista) { /* funcao declarada que recebe o parametro lista*/
            const div = document.getElementById("produtos"); /* elemento html id=produto e usa a variavel div*/
            div.innerHTML = ""; /*zera oq ja tinha dentro do div p evitar duplicar*/
            lista.forEach(p => { /*laço p correr cada item da lista*/
                const card = document.createElement('div');
                card.className = 'produto-card';
                card.innerHTML = `
                    <img src="${p.image}" alt="${p.title}">
                    <p>${p.title}</p>
                    <strong>R$ ${p.price.toFixed(2)}</strong>
                `;
                card.addEventListener('click', () => mostrarDetalhes(p));
                div.appendChild(card);
            });
        }

        fetch("https://fakestoreapi.com/products") /*fetch q serve p buscar os produto na API*/
            .then(res => res.json()) /*transforma o array em obj*/
            .then(data => {
                produtos = data;
                renderizar(produtos); /*mostra na tela tudo. obs: tem na doc esse trecho de codigo!!*/
            });

        document.getElementById("filtro").addEventListener("change", e => { /*pega o menu e adc o evento nele, evento change atv*/
            let ordenado = [...produtos]; /*eh criado uma copia do array usando esse spread (...produtos)*/
            if (e.target.value === "menor") ordenado.sort((a, b) => a.price - b.price);
            /*esse "e" eh o evento que foi usado qnd o usuario mudou a opcao em select
             e.target eh o elemento que usou o evento sendo o <select>
             e.target.value eh o valor da opcao escolhida tipo "menor" ou "maior"
            */

            if (e.target.value === "maior") ordenado.sort((a, b) => b.price - a.price);
            /*
             .sort() eh uma funcao do js que serve pra ordenar array
              ele ta comparando dois elementos de cd vez sendo a e b

              a expressao a.price - b.price decide a ordem
              sendo negativo a vem antes do b
              positivo b vem antes do a
              zero ficam na mesma posicao
            */
            renderizar(ordenado);
        });
    </script>


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
            <p>© 2025 Unbound Place. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>