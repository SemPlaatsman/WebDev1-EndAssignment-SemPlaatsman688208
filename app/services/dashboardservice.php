<?php
require __DIR__ . '/../repositories/dashboardrepository.php';

class DashboardService {
    private $dashboardRepository;

    function __construct() {
        $this->dashboardRepository = new DashboardRepository();
    }
}
?>