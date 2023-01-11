<?php
include __DIR__ . '/../header.php';
require_once __DIR__ . '/../../models/book.php';
?>
<section class="container row d-flex justify-content-center pt-4 mx-auto col-md-10">
    <form class="form row col-md-12 p-0 m-0 d-flex justify-content-center" method="POST">
        <section class="form-group col-md-4 pb-2">
            <input class="form-control" type="search" placeholder="Search for a book..." name="search">
        </section>
        <section class="form-group col-md-2 px-0">
            <input class="form-control btn btn-primary" type="submit" value="Search" name="submit">
        </section>
    </form>
    <?php
        foreach($model as $book) {
    ?>
        <section class="col-lg-4 col-md-6 col-sm-12 p-2 d-flex align-items-stretch">
            <article class="card flex-fill">
                <img class="" src="<?= $book->getSmallThumbnail(); ?>" alt="" width="128" height="167">
                <section class="card-body">
                    <h5 class="card-title"><?= $book->getTitle(); ?></h5>
                    <p class="card-text"><?= $book->getTextSnippet(); ?></p>
                    <a href="/book?id=<?= $book->getId(); ?>" class="btn btn-primary">Read further!</a>
                </section>
            </article>
        </section>
    <?php
        }
    ?>
</section>
<?php
include __DIR__ . '/../footer.php';
?>