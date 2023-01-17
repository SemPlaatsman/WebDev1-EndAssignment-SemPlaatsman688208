<?php
include __DIR__ . '/../header.php';
require_once __DIR__ . '/../../models/book.php';
?>

<section class="container row d-flex justify-content-center pt-2 mx-auto col-md-10 pb-4">
    <?php if(count($model) != 1) { ?>
        <h1 class="text-center text-light">Books</h1>
        <form class="form row col-md-12 p-0 m-0 d-flex justify-content-center" method="GET" action="/books">
            <section class="form-group col-md-4 pb-2">
                <input class="form-control" type="search" placeholder="Search for a book..." name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ""; ?>">
            </section>
            <section class="form-group col-md-2 px-0">
                <input class="form-control btn btn-primary" type="submit" value="Search">
            </section>
        </form>
        <?php if(count($model) == 0) { ?>
            <h1 class="text-center"><?= isset($_GET['id']) ? "Could not find a book with id '" . $_GET['id'] . "'!" : "No books found" ?></h1>
        <?php } else { ?>
            <?php
                foreach($model as $book) {
            ?>
                <section class="col-lg-4 col-md-6 col-sm-12 p-2 d-flex align-items-stretch">
                    <article class="card flex-fill">
                        <section class="card border-0 h-100 align-items-center">
                            <a href="/books?id=<?= $book->getId(); ?>">
                                <img src="<?= $book->getSmallThumbnail(); ?>" alt="Book cover" width="150" height="195">
                            </a>
                            <section class="card-body">
                                <h5 class="card-title"><?= $book->getTitle() . ' (' . $book->getLanguage() . ')'; ?></h5>
                                <p class="card-text"><?= $book->getTextSnippet(); ?></p>
                            </section>
                        </section>
                        <section class="card-footer d-flex justify-content-between">
                            <a href="/books?id=<?= $book->getId(); ?>" class="btn btn-secondary">Read further...</a>
                            <? if (isset($_POST['bookReservationId']) && $_POST['bookReservationId'] == $book->getId()) { ?>
                                <button class="btn btn-success custom-btn-disabled">Successfully reserved!</button>
                            <? } else { ?>
                                <form class="" method="POST" id="form-<?= $book->getId(); ?>">
                                    <input type="hidden" name="bookReservationThumbnail" value="<?= $book->getSmallThumbnail(); ?>">
                                    <input type="hidden" name="bookReservationTitle" value="<?= $book->getTitle(); ?>">
                                    <button class="btn btn-primary" type="submit" form="form-<?= $book->getId(); ?>" value="<?= $book->getId(); ?>" name="bookReservationId">Reserve now!</button>
                                </form>
                            <? } ?>
                        </section>
                    </article>
                </section>
            <?php
                }
            ?>
        <?php } ?>
    <?php } else { $book = $model[0]; ?>
        <section class="text-center text-light">
            <img class="single-book-image" src="<?= $book->getSmallThumbnail(); ?>" alt="Book cover" width="256" height="334">
            <h1><?= $book->getTitle(); ?></h1>
            <h6><?= $book->getSubtitle(); ?></h6>
            <h5>By <?php $formattedAuthors = $book->getAuthors()[0]; 
                for($i = 1; $i < count($book->getAuthors()); $i++) { 
                    $formattedAuthors = $formattedAuthors . ", " . $book->getAuthors()[$i];
                }
                echo $formattedAuthors; ?></h5>
            <hr>
            <h4>Description</h4>
            <p><?= $book->getDescription(); ?></p>
            <hr>
            <dl class="row">
                <dt class="text-sm-center text-md-end col-md-6 fs-5">Id</dt>
                <dd class="text-sm-center text-md-start col-md-6 fs-5"><?= $book->getId(); ?></dd>
                <dt class="text-sm-center text-md-end col-md-6 fs-5">Published date</dt>
                <dd class="text-sm-center text-md-start col-md-6 fs-5"><?= $book->getPublishedDate(); ?></dd>
                <dt class="text-sm-center text-md-end col-md-6 fs-5">Page count</dt>
                <dd class="text-sm-center text-md-start col-md-6 fs-5"><?= $book->getPageCount(); ?></dd>
                <dt class="text-sm-center text-md-end col-md-6 fs-5">Categories</dt>
                <dd class="text-sm-center text-md-start col-md-6 fs-5"><?php $formattedCategories = $book->getCategories()[0]; 
                    for($i = 1; $i < count($book->getCategories()); $i++) { 
                        $formattedCategories = $formattedCategories . ", " . $book->getCategories()[$i];
                    }
                    echo $formattedCategories; ?>
                </dd>
                <dt class="text-sm-center text-md-end col-md-6 fs-5">Language</dt>
                <dd class="text-sm-center text-md-start col-md-6 fs-5"><?= $book->getLanguage(); ?></dd>
            </dl>
            
            <? if (isset($_POST['bookReservationId']) && $_POST['bookReservationId'] == $book->getId()) { ?>
                <button class="btn btn-success custom-btn-disabled fs-5">Successfully reserved!</button>
            <? } else { ?>
                <form class="" method="POST" id="reserve-form">
                    <input type="hidden" name="bookReservationThumbnail" value="<?= $book->getSmallThumbnail(); ?>">
                    <input type="hidden" name="bookReservationTitle" value="<?= $book->getTitle(); ?>">
                    <button class="btn btn-primary fs-5" type="submit" form="reserve-form" value="<?= $book->getId(); ?>" name="bookReservationId">Reserve now!</button>
                </form>
            <? } ?>
        </section>
    <?php } ?>
</section>

<?php
include __DIR__ . '/../footer.php';
?>