<?php
require __DIR__ . '/../repositories/dashboardrepository.php';

class DashboardService {
    private $dashboardRepository;

    function __construct() {
        $this->dashboardRepository = new DashboardRepository();
    }

    public function getDashboardData() : array {
        return $this->dashboardRepository->getDashboardData();
    }

    public function completeReservation(int $reservationId) : bool {
        return $this->dashboardRepository->completeReservation($reservationId);
    }
}
?>