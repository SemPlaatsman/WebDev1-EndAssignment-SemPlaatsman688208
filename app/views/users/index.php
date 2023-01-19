<?php
include __DIR__ . '/../header.php';
?>

<section class="w-65 my-3 ml-3 align-self-start">
    <h2 class="text-center text-light ">Members</h2>
    <section class="overflow-table">
        <table class="table table-hover table-responsive w-100" id="usertable">
            <thead class="bg-primary text-white">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody class="bg-light overflow-auto">
                <?php
                foreach($model['users'] as $member) if (!$member->getIsAdmin()) {
                ?>
                    <form class="member-form" id="delete-member-<?= $member->getId(); ?>" method="POST" onsubmit='return confirm("Are you sure you want to delete user <?= $member->getId() . " (" . $member->getUsername(); ?>)?");'>
                        <tr>
                            <th class="col-md-1 h4" scope="row"><?= $member->getId(); ?><input type="hidden" name="id" value="<?= $member->getId(); ?>"/></th>
                            <td class="col-md-10 h4"><?= $member->getUsername(); ?><input type="hidden" name="username" value="<?= $member->getUsername(); ?>"/></td>
                            <td class="col-md-1"><button form="delete-member-<?= $member->getId(); ?>" class="btn btn-primary p-1 m-0 submit align-middle w-75"><i class="fa-solid fa-trash-can h2"></i></button></td>
                        </tr>
                    </form>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</section>

<section class="w-32 my-3 mr-3 align-self-start">
    <h2 class="text-center text-light">Admins</h2>
    <table class="table table-hover table-responsive w-100">
        <thead class="bg-success text-white">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Username</th>
            </tr>
        </thead>
        <tbody class="bg-light overflow-auto">
            <?php
                foreach($model['users'] as $admin) if ($admin->getIsAdmin()) {
            ?>
                <tr>
                    <th class="col-md-3 h4" scope="row"><?= $admin->getId(); ?></th>
                    <td class="col-md-9 h4"><?= $admin->getUsername(); ?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</section>

<section class="w-65 h-100">
    <form class="row m-0 p-0 d-flex justify-content-between" method="POST" id="add-member-form">
        <input class="form-control w-32" name="username" type="text" placeholder="Username (unique)">
        <input class="form-control w-32" name="password" type="text" placeholder="Password">
        <button type="submit" form="add-member-form" class="w-32 btn <?= isset($model['successPOST']) ? ($model['successPOST'] ? "btn-success" : "btn-danger") : "btn-primary" ?> pull-right" id="add-member-button"><h4 class="m-0"><?= isset($model['successPOST']) ? ($model['successPOST'] ? "Successfully added member!" : "Could not add member!") : "Add member" ?></h4></button>
    </form>
</section>

<?php
include __DIR__ . '/../footer.php';
?>