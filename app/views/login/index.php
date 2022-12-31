<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/css/login.css" rel="stylesheet">
  </head>
  <body>

    <? 
    $file_to_search = "login.css";

    search_file('.',$file_to_search);
    
    
    
    
    function search_file($dir,$file_to_search){
    
    $files = scandir($dir);
    
    foreach($files as $key => $value){
    
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
    
        if(!is_dir($path)) {
    
            if($file_to_search == $value){
                echo "file found<br>";
                echo $path;
                file_get_contents($path);
                break;
            }
    
        } else if($value != "." && $value != "..") {
    
            search_file($path, $file_to_search);
    
        }  
     }
    }


    ?>
    <div class="jumbotron text-center" id="test">
        <h1>Library System</h1>
        <p>Welcome to the Library Management System made by Sem Plaatsman</p>
    </div>

    <div class="container row m-auto">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>