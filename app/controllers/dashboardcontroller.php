<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/dashboardservice.php';

class DashboardController extends Controller {
    private $dashboardService;

    function __construct() {
        $this->dashboardService = new DashboardService();
    }

    public function index() {
        $user = unserialize($_SESSION['user']);
        $model = $this->dashboardService->getDashboardData(!$user->getIsAdmin() ? $user->getId() : null);

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            $model += ['successPOST' => false];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (isset($_POST['reservationId']) && !empty($_POST['reservationId'])) {
                $model['successPOST'] = $this->dashboardService->completeReservation($_POST['reservationId']);
            }
            else if (isset($_POST['collectUsername']) && isset($_POST['collectReservationId']) && !empty($_POST['collectUsername']) && !empty($_POST['collectReservationId'])) {
                $model['successPOST'] = $this->dashboardService->collectBook($_POST['collectUsername'], $_POST['collectReservationId']);
            }
            else if (isset($_POST['returnReservationId']) && !empty($_POST['returnReservationId'])) {
                $model['successPOST'] = $this->dashboardService->returnBook($_POST['returnReservationId']);
            }
        }

        $this->displayView($model);
    }
}
?>