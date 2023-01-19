<?php
require_once __DIR__ . '/../repositories/dashboardrepository.php';

class DashboardService {
    private $dashboardRepository;

    function __construct() {
        $this->dashboardRepository = new DashboardRepository();
    }

    public function getDashboardData(int $userId = null) : array {
        return $this->dashboardRepository->getDashboardData($userId);
    }

    public function completeReservation(int $reservationId) : bool {
        return $this->dashboardRepository->completeReservation($reservationId);
    }

    public function collectBook(string $username, int $reservationId) : bool {
        return $this->dashboardRepository->collectBook($username, $reservationId);
    }

    public function returnBook(int $reservationId) : ?DateTime {
        return $this->dashboardRepository->returnBook($reservationId);
    }
}
?>