<?php
    require __DIR__ . '/../services/loginservice.php';

    class LoginController {
        private $loginService;

        function __construct() {
            $this->loginService = new LoginService();
        }

        public function index() {
            require __DIR__ . '/../views/login/index.php';
        }
    }
?>