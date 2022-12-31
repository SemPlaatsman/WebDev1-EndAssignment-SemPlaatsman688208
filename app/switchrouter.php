<?php
    class SwitchRouter {
        public function route($uri) {
            // strip paramaters
            $uri = $this->stripParameters($uri);
            
            // switch statement to route URL's to other classes
            switch($uri) {
                case '':
                    require __DIR__ . '/controllers/logincontroller.php';
                    $controller = new LoginController();
                    $controller->index();
                    break;

                case 'dashboard':
                    require __DIR__ . '/controllers/dashboardcontroller.php';
                    $controller = new DashboardController();
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
?>