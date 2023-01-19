<?php
require_once("models/user.php");
class SwitchRouter {
    public function route($uri) {
        // strip paramaters
        $uri = $this->stripParameters($uri);
        
        // switch statement to route URL's to other classes
        (session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED) ? session_start() : null;
        switch([$uri, isset($_SESSION['user']), isset($_SESSION['user']) && unserialize($_SESSION['user'])->getIsAdmin()]) {
            case ['', false, false]:
                require __DIR__ . '/controllers/logincontroller.php';
                $controller = new LoginController();
                $controller->index();
                break;

            case ['', true, true]:
            case ['', true, false]:
                header("Location: /dashboard");
                break;


            case ['dashboard', true, true]:
            case ['dashboard', true, false]:
                require __DIR__ . '/controllers/dashboardcontroller.php';
                $controller = new DashboardController();
                $controller->index();
                break;

            case ['users', true, true]:
                require __DIR__ . '/controllers/userscontroller.php';
                $controller = new UsersController();
                $controller->index();
                break;

            case ['logout', true, true]:
            case ['logout', true, false]:
            case ['logout', false, false]:
                unset($_SESSION['user']);
                header("Location: /");
                break;

            case ['myprofile', true, false]:
                require __DIR__ . '/controllers/myprofilecontroller.php';
                $controller = new MyProfileController();
                $controller->index();
                break;

            case ['books', true, true]:
            case ['books', true, false]:
                require __DIR__ . '/api/controllers/bookscontroller.php';
                $controller = new BooksController();
                $controller->index();
                break;
            
            default:
                http_response_code(404);
                die();
        }
    }

    // stripParameters method based on the method from my teacher: https://github.com/ahrnuld/php-mvc-basic/blob/master/app/routers/switchrouter.php 
    private function stripParameters($uri) {
        // if(str_contains($uri, '?')) {
        //     $uri = substr($uri, 0, strpos($uri, '?'));
        // }
        // return $uri;
        return  str_contains($uri, '?') ?
                substr($uri, 0, strpos($uri, '?')) : 
                $uri;
    }
}