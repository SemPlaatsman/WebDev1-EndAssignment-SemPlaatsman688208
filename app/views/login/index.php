<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>

    <section class="jumbotron text-center bg-dark text-light h-99 p-1">
        <h1>Library System</h1>
        <p>Welcome to the Library Management System made by Sem Plaatsman</p>
    </section>

    <br>
    <div class="container" id="login-container">
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
        <form class="col-md-4 mx-auto row" method="POST" id="login-form">
            <h1 class="text-center text-light">Login</h1>
            <div class="form-group p-2">
                <label class="text-light fs-5" for="usernameField">Username:</label>
                <input class="w-100" id="usernameField" type="text" name="username" />
            </div>
            <div class="form-group p-2">
                <label class="text-light fs-5" for="passwordField">Password:</label>
                <input class="w-100" id="passwordField" type="password" name="password" />
            </div>
            <hr class="invisible">
            <hr class="custom-hr bg-black opacity-100">
            <input class="btn btn-primary" type="submit" value="Login" name="submit" />
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
  </body>
</html>