<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/login.css" rel="stylesheet">
  </head>
  <body>

    <div class="jumbotron text-center bg-dark text-light h-99">
        <h1>Library System</h1>
        <p>Welcome to the Library Management System made by Sem Plaatsman</p>
    </div>

    <!-- <div class="container row m-auto">
        <div class="col-md-6 text-center">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>Admin Login</h2>
                <p></p>
                <a href="admin_login.php" class="btn btn-outline-light">Admin Login</a>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>User Login</h2>
                <p></p>
                <a href="user_login.php" class="btn btn-outline-secondary">User Login</a>
                <a href="user_registration.php" class="btn btn-outline-primary">User Sign Up</a>
            </div>
        </div>
    </div> -->

    <!-- <div class="container">
        <form class="form" id="loginForm" method="POST">
            <h1 class="text-center">Login</h1>
            <div class="form-group">
                <label class="col-md-2" for="usernameField">Username:</label>
                <input class="col-md-6" id="usernameField" type="text" name="username" />
            </div>
            <div class="form-group row">
                <label for="passwordField">Password:</label>
                <input id="passwordField" type="password" name="password" />
            </div>
            <div class="form-group row">
                <label>&nbsp;</label>
                <input type="submit" value="Login" name="submit" />
            </div>
        </form>
    </div> -->
    <div class="container justify-content-center" id="loginContainer">
        <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (empty($_POST['username']) || empty($_POST['password']) || !isset($_POST['username']) || !isset($_POST['password'])) {
                    echo "Please fill all fields!";
                } else {
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);
                    $user = $this->validateUser($username, $password);
                    if ($user != null) {
                        (session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED) ? session_start() : null;
                        $_SESSION['user'] = serialize($user);
                        if ($user->getIsAdmin()) {
                            echo '<script class="invisible">window.location="dashboard"</script>';
                        } else {
                            echo '<script class="invisible">window.location="home"</script>';
                        }
                        exit();
                    } else {
                        echo "Invalid username/password combination!";
                    }
                }
            }
        ?>
        <form class="col-md-4 mx-auto row" method="POST">
            <h1 class="text-center">Login</h1>
            <div class="form-group p-2">
                <label class="" for="usernameField">Username:</label>
                <input class="w-100" id="usernameField" type="text" name="username" />
            </div>
            <div class="form-group p-2">
                <label class="" for="passwordField">Password:</label>
                <input class="w-100" id="passwordField" type="password" name="password" />
            </div>
            <hr class="invisible">
            <hr class="p-1">
            <input class="btn btn-primary" type="submit" value="Send" name="submit" />
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
  </body>
</html>