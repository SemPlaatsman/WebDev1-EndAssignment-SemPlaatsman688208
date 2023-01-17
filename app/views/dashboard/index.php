<?php
include __DIR__ . '/../header.php';
require_once __DIR__ . '/../../models/bookreservation.php';
// $model['bookReservations'] = [
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0),
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0),
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0),
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0),
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0),
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0),
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0),
//     new BookReservation(1, 2, "/img/png/coverunavailable.png", "test", 3, "2023-01-01", 0)
// ];
?>

<section class="col-lg-3 col-md-6 p-2 d-flex align-items-stretch">
    <article class="card card-body bg-primary text-white text-center flex-fill">
        <h4>Books to be reserved</h4>
        <h1><?= $model['nrToBeReserved']?></h1> 
    </article>
</section>

<section class="col-lg-3 col-md-6 p-2 d-flex align-items-stretch">
    <article class="card card-body bg-info text-white text-center flex-fill">
        <h4>Books to be picked up</h4>
        <h1><?= $model['nrReserved']?></h1>
    </article>
</section>

<section class="col-lg-3 col-md-6 p-2 d-flex align-items-stretch">
    <article class="card card-body bg-success text-white text-center flex-fill">
        <h4>Books lend out</h4>
        <h1><?= $model['nrLendOut']?></h1>
    </article>
</section>

<section class="col-lg-3 col-md-6 p-2 d-flex align-items-stretch">
    <article class="card card-body bg-danger text-white text-center flex-fill">
        <h4>Books late</h4>
        <h1><?= $model['nrLate']?></h1>
    </article>
</section>

<h2 class="w-75 mx-auto text-light text-center py-2">Books to be reserved:</h2>
<section class="overflow-table vh-70 d-flex justify-content-center w-75 mx-auto p-0">
    <table class="table table-hover table-responsive w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th class="col-md-1" scope="col">Thumbnail</th>
                <th class="col-md-3" scope="col">Title</th>
                <th class="col-md-4" scope="col">Lending date <small class="fs-6 d-none d-sm-none d-md-inline">(day-month-year)</small></th>
                <th class="col-md-4" scope="col">Handle reservation</th>
            </tr>
        </thead>
        <tbody class="bg-light overflow-auto">
            <?php
                foreach ($model['bookReservations'] as $bookReservation) if ($bookReservation->getBookStatus() == BookStatus::TO_BE_RESERVED) {
            ?>
                <tr>
                    <td class="" scope="row">
                        <a href="/books?id=<?= $bookReservation->getBookId(); ?>">
                            <img class="hover-img" src="<?= $bookReservation->getBookThumbnail(); ?>" alt="Book cover" width="96" height="125">
                        </a>
                    </td>
                    <td class="">
                        <a class="link-dark" href="/books?id=<?= $bookReservation->getBookId(); ?>">
                            <?= $bookReservation->getBookTitle(); ?>
                        </a>
                    </td>
                    <td class=""><?= date_format($bookReservation->getLendingDate(), 'd-m-Y'); ?></td>
                    <td class="">
                        <form method="post" id="form-<?= $bookReservation->getId(); ?>">
                            <button class="btn btn-primary" form="form-<?= $bookReservation->getId(); ?>" type="submit" name="reservationId" value="<?= $bookReservation->getId(); ?>">Complete reservation</button>
                        </form>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</section>

<?php
include __DIR__ . '/../footer.php';
?>