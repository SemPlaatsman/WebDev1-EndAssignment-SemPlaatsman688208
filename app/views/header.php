<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/<?= strtolower($directory); ?>.css">
  </head>
  <body>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark p-2" role="navigation">
    <a class="navbar-brand <?= strtolower($directory) == "home" ? "text-white" : "" ?>"
       href="/home"><i class="fa-solid fa-building-columns"></i> Library Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <section class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto w-100 px-auto">
            <section class="w-100 d-flex flex-row justify-content-center">
                <li class="nav-item w-auto text-center">
                    <a class="nav-link <?= strtolower($directory) == "home" ? "text-white bg-black" : "" ?>"
                        href="/home"><i class="fa-solid fa-building-columns"></i> Home</a>
                </li>
                <?php
                    if (unserialize($_SESSION['user'])->getIsAdmin()) {
                ?>
                    <li class="nav-item w-auto text-center">
                        <a class="nav-link <?= strtolower($directory) == "dashboard" ? "text-white bg-black" : "" ?>"
                           href="/dashboard"><i class="fa-sharp fa-solid fa-gauge-high"></i> Dashboard</a>
                    </li>
                    <li class="nav-item w-auto text-center">
                        <a class="nav-link <?= strtolower($directory) == "books" ? "text-white bg-black" : "" ?>"
                           href="#"><i class="fa-solid fa-book"></i> Books</a>
                    </li>
                    <li class="nav-item w-auto text-center">
                        <a class="nav-link <?= strtolower($directory) == "users" ? "text-white bg-black" : "" ?>"
                           href="/users"><i class="fa-solid fa-user"></i> Users</a>
                    </li>
                <?php
                    } else {
                ?>
                    <li class="nav-item w-auto text-center">
                        <a class="nav-link <?= strtolower($directory) == "myprofile" ? "text-white bg-black" : "" ?>"
                           href="/myprofile"><i class="fa-solid fa-user"></i> My profile</a>
                    </li>
                <?php
                    }
                ?>
            </section>
            <li class="nav-item logout">
                <a class="nav-link pull-right" href="/logout">Log out <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </li>
        </ul>
    </section>
  </nav>
  <main class="container-fluid row align-items-center m-0 p-0">
    <!-- <div class="row">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark col-2 min-vh-100 ">
            <a href="/" class="d-flex align-items-center text-white text-decoration-none"><span class="fs-2">Library System<span></a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Books</a>
                </li>
            </ul>
            <hr>
        </div>
    </div> -->