<?php require_once __DIR__ . '/includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamList - Sua vitrine de filmes e séries</title>
    
    <link rel="icon" type="image/svg+xml" href="/streamlist/logo-icone.svg">

    <link rel="stylesheet" href="/streamlist/assets/style.css">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="container">

        <!-- ---------- Destaque ---------- -->
        <section class="home-hero">
            <div class="home-texto">
                <span class="home-etiqueta">Sua vitrine pessoal de streaming</span>
                <h1>Tudo o que você assiste, <span>organizado</span> em um só lugar.</h1>
                <p>
                    Cadastre filmes e séries, acompanhe o que já viu, o que está vendo
                    e o que pretende ver. Dê uma nota e escreva sua opinião/review.
                </p>
                <div class="acoes">
                    <?php if (isset($_SESSION['id'])) { ?>
                        <a class="btn" href="/streamlist/app/read.php">Ver minha vitrine</a>
                        <a class="btn-sec" href="/streamlist/app/create.php">Adicionar título</a>
                    <?php } else { ?>
                        <a class="btn" href="/streamlist/login/cadastrar.php">Criar conta grátis</a>
                        <a class="btn-sec" href="/streamlist/login/login.php">Já tenho conta</a>
                    <?php } ?>
                </div>
            </div>

            <!-- Exemplo visual da vitrine (só decoração) -->
            <div class="home-mostra">
                <div class="mini-card">
                    <div class="mini-capa mini-capa-1">
                        <span class="selo selo-assistido">Assistido</span>
                        <span class="nota">★ 9</span>
                    </div>
                    <p class="mini-titulo">Filme</p>
                </div>
                <div class="mini-card">
                    <div class="mini-capa mini-capa-2">
                        <span class="selo selo-assistindo">Assistindo</span>
                        <span class="nota">★ 8</span>
                    </div>
                    <p class="mini-titulo">Série</p>
                </div>
                <div class="mini-card">
                    <div class="mini-capa mini-capa-3">
                        <span class="selo selo-quero">Quero assistir</span>
                    </div>
                    <p class="mini-titulo">Filme</p>
                </div>
            </div>
        </section>

        <!-- ---------- Como funciona ---------- -->
        <section class="home-secao">
            <h2>Como funciona</h2>
            <p class="home-sub">Três passos e a sua vitrine está pronta.</p>

            <div class="passos">
                <div class="passo">
                    <span class="passo-num">1</span>
                    <h3>Crie sua conta</h3>
                    <p>Cadastre-se com e-mail e senha. Cada pessoa tem a sua própria vitrine.</p>
                </div>
                <div class="passo">
                    <span class="passo-num">2</span>
                    <h3>Adicione títulos</h3>
                    <p>Digite o nome, escolha a capa encontrada pela API e defina o status.</p>
                </div>
                <div class="passo">
                    <span class="passo-num">3</span>
                    <h3>Acompanhe tudo</h3>
                    <p>Veja sua nota média, filtre por status e edite quando quiser.</p>
                </div>
            </div>
        </section>

        <!-- ---------- Recursos ---------- -->
        <section class="home-secao">
            <h2>O que você pode fazer</h2>
            <p class="home-sub">Simples de usar, com o que importa para organizar sua lista.</p>

            <div class="recursos">
                <div class="recurso">
                    <h3>Status do título</h3>
                    <p>Separe o que você quer assistir, está assistindo ou já assistiu.</p>
                </div>
                <div class="recurso">
                    <h3>Notas e reviews</h3>
                    <p>Avalie de 1 a 10 e guarde um comentário sobre cada título.</p>
                </div>
                <div class="recurso">
                    <h3>Capas automáticas</h3>
                    <p>Ao digitar o nome, as capas aparecem para você escolher.</p>
                </div>
                <div class="recurso">
                    <h3>Busca e filtros</h3>
                    <p>Encontre qualquer título pelo nome ou pela aba de status.</p>
                </div>
            </div>
        </section>

        <!-- ---------- Chamada final ---------- -->
        <section class="home-final">
            <h2>Pronto para montar a sua vitrine?</h2>
            <p>Comece agora e nunca mais esqueça o que queria assistir.</p>
            <div class="acoes">
                <?php if (isset($_SESSION['id'])) { ?>
                    <a class="btn" href="/streamlist/app/create.php">Adicionar um título</a>
                <?php } else { ?>
                    <a class="btn" href="/streamlist/login/cadastrar.php">Começar agora</a>
                <?php } ?>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>