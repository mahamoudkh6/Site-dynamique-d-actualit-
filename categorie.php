<!-- EN-TETE DE PAGE -->
<?php require_once 'partials/header.php' ?>
<pre>
<?php
    # Récupération de mon paramètre "name" dans l'URL
    # print_r( $_GET['name'] );
    # $category = isset($_GET['name']) ? $_GET['name'] : 'Politique'; // Condition Ternaire
    $slug = $_GET['name'] ?? 'politique';  // Condition ternaire réduite

    # Récupérer la catégorie
    $category = getCategoryBySlug($slug);
    # debug($category);

    # Récupération des articles
    $posts = getPostsByCategory($category['id']);
    # debug($posts);
?>
</pre>
<!-- TITRE DE LA PAGE -->
<div class="p-3 mx-auto text-center">
    <h1 class="display-4"><?= $category['name'] ?></h1>
</div>

<!-- CONTENU DE LA PAGE -->
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <?php if (empty($posts)) : ?>
                <div class="alert alert-info">
                    Pas d'article dans cette catégorie.
                </div>
            <?php endif ?>
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-4 mt-4">
                    <div class="card shadow-sm">
                        <img class="card-img-top"
                             src="<?= $post['image'] ?>" alt="<?= $post['title'] ?>">
                        <div class="card-body">
                            <h2 class="card-title fs-4 display-1"><?= $post['title'] ?></h2>
                            <div class="card-text"><?= summarize($post['content'], 150) ?></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><?= $post['firstname'] ?> <?= $post['lastname'] ?></small>
                                <a href="article.php?slug=<?= $post['postSlug'] ?>" class="btn btn-dark">
                                    Lire la suite
                                </a>
                            </div>
                        </div>
                    </div> <!-- ./card -->
                </div> <!-- ./col-md-4 -->
            <?php endforeach; ?>
        </div> <!-- ./row -->
    </div> <!-- ./container -->
</div> <!-- ./bg-light -->

<!-- PIED DE PAGE -->
<?php require_once 'partials/footer.php' ?>
