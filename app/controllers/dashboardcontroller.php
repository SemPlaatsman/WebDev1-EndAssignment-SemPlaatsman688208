<?php
    require __DIR__ . '/../services/dashboardservice.php';

    class DashboardController {
        private $dashboardService;

        function __construct() {
            $this->dashboardService = new DashboardService();
        }

        public function index() {
            require __DIR__ . '/../views/dashboard/index.php';
        }
    }
?>