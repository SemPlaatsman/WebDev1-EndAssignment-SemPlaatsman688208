<?php
require_once __DIR__ . '/models/user.php';

class SwitchRouter {
    public function route($uri) {
        // strip paramaters
        $uri = $this->stripParameters($uri);

        // start session if it hasn't been started yet
        (session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED) ? session_start() : null;
                
        // switch statement to route URL's to other classes
        switch([$uri, isset($_SESSION['user']), isset($_SESSION['user']) && unserialize($_SESSION['user'])->getIsAdmin()]) {
            // login
            case ['', false, false]:
                require_once __DIR__ . '/controllers/logincontroller.php';
                $controller = new LoginController();
                $controller->index();
                break;

            // if logged in, send to dashboard
            case ['', true, true]:
            case ['', true, false]:
                header("Location: /dashboard");
                break;

            // if dashboard, accept logged in members and admins
            case ['dashboard', true, true]:
            case ['dashboard', true, false]:
                require_once __DIR__ . '/controllers/dashboardcontroller.php';
                $controller = new DashboardController();
                $controller->index();
                break;

            // if users, accept logged in admins
            case ['users', true, true]:
                require_once __DIR__ . '/controllers/userscontroller.php';
                $controller = new UsersController();
                $controller->index();
                break;

            // if logout, destroy session data and send to root
            case ['logout', true, true]:
            case ['logout', true, false]:
            case ['logout', false, false]:
                unset($_SESSION['user']);
                header("Location: /");
                break;

            // if myprofile, accept logged in members
            case ['myprofile', true, false]:
                require_once __DIR__ . '/controllers/myprofilecontroller.php';
                $controller = new MyProfileController();
                $controller->index();
                break;

            // if books, accept logged in members and admins
            case ['books', true, true]:
            case ['books', true, false]:
                require_once __DIR__ . '/api/controllers/bookscontroller.php';
                $controller = new BooksController();
                $controller->index();
                break;
            
            // default, send 404
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