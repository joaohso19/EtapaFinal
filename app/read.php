<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';

$titulos = relatorio($conexao, $_SESSION['id']);

// contagem de títulos para os números das abas
$e = ['total' => 0, 'quero' => 0, 'assistindo' => 0, 'assistido' => 0];

foreach ($titulos as $t) {
    $e['total']++;

    if ($t['status'] == 'quero') { $e['quero']++; }
    if ($t['status'] == 'assistindo') { $e['assistindo']++; }
    if ($t['status'] == 'assistido') { $e['assistido']++; }
}

// nomes que aparecem na tela para cada status
$nomes = [
    'quero' => 'Quero assistir',
    'assistindo' => 'Assistindo',
    'assistido' => 'Assistidos'
];

// filtro escolhido na aba (?filtro=assistindo)
$filtro = 'todos';
if (isset($_GET['filtro'])) {
    $filtro = $_GET['filtro'];
}

// texto digitado na busca (?busca=naruto)
$busca = '';
if (isset($_GET['busca'])) {
    $busca = trim($_GET['busca']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamList - Minha vitrine</title>
    <link rel="stylesheet" href="/streamlist/assets/style.css">
    <link rel="icon" type="image/svg+xml" href="/streamlist/logo-icone.svg">
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <main class="container">

        <form class="busca" action="" method="get">
            <input type="hidden" name="filtro" value="<?php echo htmlspecialchars($filtro); ?>">
            <input type="text" name="busca" placeholder="Buscar por título..." value="<?php echo htmlspecialchars($busca); ?>">
            <input class="btn" type="submit" value="Buscar">
            <?php if ($busca != '') { ?>
                <a class="btn-sec" href="?filtro=<?php echo htmlspecialchars($filtro); ?>">Limpar</a>
            <?php } ?>
        </form>

        <nav class="abas">
            <a class="aba <?php if ($filtro == 'todos') { echo 'ativa'; } ?>" href="?filtro=todos&busca=<?php echo urlencode($busca); ?>">
                Todos <span><?php echo $e['total']; ?></span>
            </a>
            <a class="aba <?php if ($filtro == 'quero') { echo 'ativa'; } ?>" href="?filtro=quero&busca=<?php echo urlencode($busca); ?>">
                Quero assistir <span><?php echo $e['quero']; ?></span>
            </a>
            <a class="aba <?php if ($filtro == 'assistindo') { echo 'ativa'; } ?>" href="?filtro=assistindo&busca=<?php echo urlencode($busca); ?>">
                Assistindo <span><?php echo $e['assistindo']; ?></span>
            </a>
            <a class="aba <?php if ($filtro == 'assistido') { echo 'ativa'; } ?>" href="?filtro=assistido&busca=<?php echo urlencode($busca); ?>">
                Assistidos <span><?php echo $e['assistido']; ?></span>
            </a>
        </nav>

        <div class="grade">
            <?php
            $mostrou = false;
            foreach ($titulos as $t) {
                // o título precisa passar na aba escolhida E no texto da busca
                $passa_filtro = ($filtro == 'todos' || $t['status'] == $filtro);
                $passa_busca = ($busca == '' || mb_stripos($t['titulo'], $busca) !== false);

                if ($passa_filtro && $passa_busca) {
                    $mostrou = true;
            ?>
                <article class="card">
                    <div class="poster">
                        <?php if ($t['capa']) { ?>
                            <img src="<?php echo htmlspecialchars($t['capa']); ?>" alt="Capa de <?php echo htmlspecialchars($t['titulo']); ?>">
                        <?php } else { ?>
                            <div class="sem-capa">Sem capa</div>
                        <?php } ?>

                        <span class="selo selo-<?php echo $t['status']; ?>"><?php echo $nomes[$t['status']]; ?></span>

                        <?php if ($t['nota']) { ?>
                            <span class="nota">★ <?php echo htmlspecialchars($t['nota']); ?></span>
                        <?php } ?>
                    </div>
                    <div class="info">
                        <h3><?php echo htmlspecialchars($t['titulo']); ?></h3>

                        <?php if ($t['tipo'] == 'filme') { ?>
                            <p class="tipo">Filme</p>
                        <?php } else { ?>
                            <p class="tipo">Série</p>
                        <?php } ?>

                        <?php if ($t['review']) { ?>
                            <p class="review">“<?php echo htmlspecialchars($t['review']); ?>”</p>
                        <?php } ?>

                        <div class="links">
                            <a href="/streamlist/app/update.php?id=<?php echo $t['id']; ?>">Editar</a>
                            <a class="excluir" href="/streamlist/app/delete.php?id=<?php echo $t['id']; ?>">Excluir</a>
                        </div>
                    </div>
                </article>
            <?php
                }
            }
            ?>
        </div>

        <?php if (!$mostrou) { ?>
            <?php if ($busca != '') { ?>
                <p class="vazio">Nenhum título encontrado para essa busca.</p>
            <?php } else { ?>
                <p class="vazio">Nada por aqui ainda. <a href="/streamlist/app/create.php">Adicione um título</a>.</p>
            <?php } ?>
        <?php } ?>

    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>