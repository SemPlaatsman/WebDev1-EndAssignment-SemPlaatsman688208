<?php
include __DIR__ . '/../header.php';
require_once __DIR__ . '/../../models/bookreservation.php';
?>

<section class="col-lg-3 col-md-6 p-2 pb-0 d-flex align-items-stretch">
    <article class="card card-body bg-primary text-white text-center flex-fill">
        <h4>Books to be reserved</h4>
        <h1><?= $model['nrToBeReserved']?></h1> 
    </article>
</section>

<section class="col-lg-3 col-md-6 p-2 pb-0 d-flex align-items-stretch">
    <article class="card card-body bg-info text-white text-center flex-fill">
        <h4>Books to be picked up</h4>
        <h1><?= $model['nrReserved']?></h1>
    </article>
</section>

<section class="col-lg-3 col-md-6 p-2 pb-0 d-flex align-items-stretch">
    <article class="card card-body bg-success text-white text-center flex-fill">
        <h4>Books lend out</h4>
        <h1><?= $model['nrLendOut']?></h1>
    </article>
</section>

<section class="col-lg-3 col-md-6 p-2 pb-0 d-flex align-items-stretch">
    <article class="card card-body bg-danger text-white text-center flex-fill">
        <h4>Books late</h4>
        <h1><?= $model['nrLate']?></h1>
    </article>
</section>

<?php if (unserialize($_SESSION['user'])->getIsAdmin()) { ?>

    <section class="col-md-6">
        <h2 class="text-light text-center m-0 pb-2">Books to be reserved</h2>
        <section class="overflow-table vh-70 w-100 p-0 px-2">
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
                        foreach ($model['bookReservations'] as $bookReservation) if ($bookReservation->getBookStatus() == 0 /* TO_BE_RESERVED */) {
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
    </section>

    <section class="col-md-3 text-center">
        <h2 class="w-100 text-light mb-2 pb-2">Collect books</h2>
        <section class="vh-70">
            <form class="row d-flex justify-content-center gy-2 col-md-10 mx-auto bg-light p-4 rounded border border-4 border-primary" method="post" id="collect-form">
                <label class="text-dark text-start fs-5 px-0" for="username">Username</label>
                <input type="text" name="collectUsername" id="username" value="<?= (isset($model['successPOST']) && isset($_POST['collectUsername']) && isset($_POST['collectReservationId'])) ? $_POST['collectUsername'] : "" ?>">
                <label class="text-dark text-start fs-5 px-0" for="reservationId">Reservation ID</label>
                <input type="text" name="collectReservationId" id="reservationId" value="<?= (isset($model['successPOST']) && isset($_POST['collectUsername']) && isset($_POST['collectReservationId']) && !$model['successPOST']) ? $_POST['collectReservationId'] : "" ?>">
                <button class="btn btn-primary col-md-8 <?= (isset($model['successPOST']) && isset($_POST['collectUsername']) && isset($_POST['collectReservationId'])) ? ($model['successPOST'] ? "is-valid" : "is-invalid") : "" ?>" form="collect-form" type="submit">Collect book</button>
                <p class="invalid-feedback text-light p-1 my-0 mt-3 bg-danger rounded">Invalid username/reservation id combination!</p>
                <p class="valid-feedback text-light p-1 my-0 mt-3 bg-success rounded">Collected reservation <?= isset($POST['collectReservationId']) ? $POST['collectReservationId'] . " " : "" ?>for <?= $POST['collectUsername'] ?? "user" ?>!</p>
            </form>
        </section>
    </section>

    <section class="col-md-3 text-center">
        <h2 class="w-100 text-light mb-2 pb-2">Return books</h2>
        <section class="vh-70">
            <form class="row d-flex justify-content-center gy-2 col-md-10 mx-auto bg-light p-4 rounded border border-4 border-primary" method="post" id="return-form">
                <label class="text-dark text-start fs-5 px-0" for="reservationId">Reservation ID</label>
                <input type="text" name="returnReservationId" id="reservationId" value="<?= (isset($model['successPOST']) && isset($_POST['returnReservationId']) && !$model['successPOST']) ? $_POST['returnReservationId'] : "" ?>">
                <button class="btn btn-primary col-md-8 <?= (isset($model['successPOST']) && isset($_POST['returnReservationId'])) ? ($model['successPOST'] ? "is-valid" : "is-invalid") : "" ?>" form="return-form" type="submit">Return book</button>
                <p class="invalid-feedback text-light p-1 my-0 mt-3 bg-danger rounded">Invalid reservation id!</p>
                <p class="valid-feedback text-light p-1 my-0 mt-3 bg-success rounded">Returned reservation<?= isset($POST['returnReservationId']) ? " " . $POST['returnReservationId'] : "" ?>!</p>
                <?php if (isset($model['successPOST']) && $model['successPOST'] && isset($model['returnLendingDate']) && $model['returnLendingDate']->diff(new DateTime())->days > 28) { ?>
                    <p class="bg-danger text-light">Fine: €<?= sprintf("%.2f", floatval(($model['returnLendingDate']->diff(new DateTime())->days - 28) / 5)) ?></p>
                    <button type="button" class="btn btn-primary" onclick="payFine()" id="payFineButton">Pay fine</button>
                <?php } ?>
            </form>
        </section>
    </section>

<?php } else { ?>

    <h1 class="w-100 text-center text-light mt-3 display-1 fw-normal">Welcome <?= unserialize($_SESSION['user'])->getUsername() ?>!</h1>
    <section class="col-md-6 vh-50 row align-items-md-center p-5 mt-5">
        <section class="card border-primary border-4 mx-auto col-md-6 text-center vh-50 p-0">
            <h1 class="card-header border-primary bg-primary text-light">Check out your profile!</h1>
            <section class="card-body row align-items-center">
                <a href="/myprofile">
                    <i class="fa-solid fa-user fa-10x text-primary"></i>
                </a>
            </section>
        </section>
    </section>
    <section class="col-md-6 vh-50 row align-items-md-center p-5 mt-5">
        <section class="card border-primary border-4 mx-auto col-md-6 text-center vh-50 p-0">
            <h1 class="card-header border-primary bg-primary text-light">Discover more books!</h1>
            <section class="card-body row align-items-center">
                <a href="/books">
                    <i class="fa-solid fa-book fa-10x text-primary"></i>
                </a>
            </section>
        </section>
    </section>

<?php } ?>

<?php
include __DIR__ . '/../footer.php';
?>