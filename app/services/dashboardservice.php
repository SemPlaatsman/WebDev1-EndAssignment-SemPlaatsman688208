<?php
require_once __DIR__ . '/../repositories/dashboardrepository.php';

class DashboardService {
    private $dashboardRepository;

    function __construct() {
        $this->dashboardRepository = new DashboardRepository();
    }

    /**
     * Method to get dashboard data
     * Returns an array of dashboard data
     * 
     * @param int $userId = null
     * 
     * @return array
     */
    public function getDashboardData(int $userId = null) : array {
        return $this->dashboardRepository->getDashboardData($userId);
    }

    /**
     * Method to complete a reservation
     * Returns a bool to check if the reservation was successfully completed
     * 
     * @param int $reservationId
     * 
     * @return bool
     */
    public function completeReservation(int $reservationId) : bool {
        return $this->dashboardRepository->completeReservation($reservationId);
    }

    /**
     * Method to collect a book
     * Returns a bool to check if the book was successfully collected
     * 
     * @param string $username
     * @param int $reservationId
     * 
     * @return bool
     */
    public function collectBook(string $username, int $reservationId) : bool {
        return $this->dashboardRepository->collectBook($username, $reservationId);
    }

    /**
     * Method to return a book
     * Returns a ?DateTime to check if the book was successfully return
     * If it returns null it failed to return, if it return a DateTime it was successfully returned
     * That DateTime can be used to decide if there is a fine to be paid
     * 
     * @param int $reservationId
     * 
     * @return ?DateTime
     */
    public function returnBook(int $reservationId) : ?DateTime {
        return $this->dashboardRepository->returnBook($reservationId);
    }
}
?>