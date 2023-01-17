<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/dashboardservice.php';

class DashboardController extends Controller {
    private $dashboardService;

    function __construct() {
        $this->dashboardService = new DashboardService();
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            if (isset($_POST['reservationId'])) {
                $this->dashboardService->completeReservation($_POST['reservationId']);
            }
        }

        $model = $this->dashboardService->getDashboardData();
        $this->displayView($model);
    }
}
?>