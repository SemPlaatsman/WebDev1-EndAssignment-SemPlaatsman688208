<?php
if ($_SERVER['HTTP_HOST'] != 'localhost') {
    $type = "mysql";
    $servername = "localhost";
    $username = "id17574216_developer";
    $password = "4ipzvz{SIy0vBkgX";
    $database = "id17574216_libraryd";
} else {
    $type = "mysql";
    $servername = "mysql";
    $username = "developer";
    $password = "secret123";
    $database = "librarydb";
}
?>