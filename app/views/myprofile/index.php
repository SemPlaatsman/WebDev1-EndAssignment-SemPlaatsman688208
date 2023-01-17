<?php
include __DIR__ . '/../header.php';
$user = unserialize($_SESSION['user']);
?>

<h1 class="w-75 mx-auto text-light text-center pb-2 pt-4">Welcome <?= $user->getUsername(); ?>! Your user id is <?= $user->getId(); ?></h1>
<h2 class="w-75 mx-auto text-light">Your books</h2>
<section class="overflow-table d-flex justify-content-center w-75 mx-auto p-0">
    <table class="table table-hover table-responsive w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th class="col-md-1" scope="col">Thumbnail</th>
                <th class="col-md-3" scope="col">Title</th>
                <th class="col-md-4" scope="col">Lending date <small class="fs-6 d-none d-sm-none d-md-inline">(day-month-year)</small></th>
                <th class="col-md-4" scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="bg-light overflow-auto">
            <?php
                foreach($model as $bookReservation) {
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
                    <td class=""><?= $bookReservation->getBookStatus()->toString(); ?></td>
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