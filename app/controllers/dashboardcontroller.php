<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/dashboardservice.php';
require_once __DIR__ . '/../models/bookreservation.php';

class DashboardController extends Controller {
    private $dashboardService;

    function __construct() {
        $this->dashboardService = new DashboardService();
    }

    public function index() {
        $model = [];

        // handle POST
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            $model += ['successPOST' => false];
            $this->handlePOST($model);
        }

        $user = unserialize($_SESSION['user']);
        $model = array_merge($model, $this->dashboardService->getDashboardData(!$user->getIsAdmin() ? $user->getId() : null));

        $this->displayView($model);
    }

    /**
     * Handle POST request
     * 
     * @param &$model
     */
    private function handlePOST(&$model) {
        // filter POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // complete reservation
        if (isset($_POST['reservationId']) && !empty($_POST['reservationId'])) {
            $model['successPOST'] = $this->dashboardService->completeReservation($_POST['reservationId']);
        }
        // collect book
        else if (isset($_POST['collectUsername']) && isset($_POST['collectReservationId']) && !empty($_POST['collectUsername']) && !empty($_POST['collectReservationId'])) {
            $model['successPOST'] = $this->dashboardService->collectBook($_POST['collectUsername'], $_POST['collectReservationId']);
        }
        // return book
        else if (isset($_POST['returnReservationId']) && !empty($_POST['returnReservationId'])) {
            $result = $this->dashboardService->returnBook($_POST['returnReservationId']);
            if (isset($result)) {
                $model['successPOST'] = isset($result);
                $model += ['returnLendingDate' => $result];
            }
        }
    }
}
?>