<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/bookreservation.php';

class DashboardRepository extends Repository {
    /**
     * Method to get dashboard cards
     * Returns an array of dashboard card data
     * If $userId is set, only get the dashboard data from that specific user
     * 
     * @param int $userId = null
     * 
     * @return array
     */
    public function getDashboardCards(int $userId = null) : array {
        $query = $this->connection->prepare('SELECT SUM(bookStatus = 0) as "nrToBeReserved", SUM(bookStatus = 1) as "nrReserved", SUM(bookStatus = 2) as "nrLendOut", ' .
                                            'SUM(bookStatus = 2 && lendingDate <= DATE_ADD(NOW(), INTERVAL -1 MONTH)) AS "nrLate" FROM bookReservations' .
                                            (isset($userId) ? ' WHERE userId = :userId' : '') .
                                            ';');
        if (isset($userId)) {
            $query->bindParam(":userId", $userId);
        }
        $query->execute();
        $dashboardCards = $query->fetchAll(PDO::FETCH_ASSOC)[0] ?? null;
        return $dashboardCards;
    }

    /**
     * Method to get all book reservation
     * Returns an array of book reservations
     * If $reservationId is set, only get the book reservations associated with that reservationId
     * 
     * @param int $reservationId = null
     * 
     * @return array
     */
    public function getAllBookReservations(int $reservationId = null) : array {
        $query = $this->connection->prepare('SELECT id, bookId, bookThumbnail, bookTitle, userId, lendingDate, bookStatus FROM bookReservations' .
                                            (isset($reservationId) ? ' WHERE id = :reservationId' : '') .
                                            ';');
        if (isset($reservationId)) {
            $query->bindParam("reservationId", $reservationId);
        }
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'BookReservation');

        // if rowMapper function is already loaded, don't load it again
        if (!function_exists('rowMapper')) {
            // rowMapper based on this stackoverflow post: https://stackoverflow.com/questions/12368035/pdo-fetch-class-pass-results-to-constructor-as-parameters
            function rowMapper($id, $bookId, $bookThumbnail, $bookTitle, $userId, $lendingDate, $bookStatus) {
                return new BookReservation($id, $bookId, $bookThumbnail, $bookTitle, $userId, $lendingDate, $bookStatus);
            }
        }
        
        $bookReservations = $query->fetchAll(PDO::FETCH_FUNC, 'rowMapper');
        return $bookReservations;
    }

    /**
     * Method to get dashboard data from getDashboardCards(int $userId = null) and getAllBookReservations(int $reservationId = null)
     * Returns an array of dashboard data
     * 
     * @param int $userId = null
     * 
     * @return array
     */
    public function getDashboardData(int $userId = null) : array {
        $dashboardData = $this->getDashboardCards($userId);
        if (!isset($userId)) {
            $bookReservations =  $this->getAllBookReservations();
            $dashboardData += ['bookReservations' => $bookReservations];
        }
        return $dashboardData;
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
        $query = $this->connection->prepare('UPDATE bookReservations SET bookStatus = 1 WHERE id = :reservationId LIMIT 1;');
        $query->bindParam(":reservationId", $reservationId);
        $query->execute();
        return boolval($query->rowCount());
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
        $query = $this->connection->prepare('UPDATE bookReservations SET bookStatus = 2 WHERE id = :reservationId && ' . 
                                            'userId = (SELECT users.id FROM users WHERE users.username = :username) LIMIT 1;');
        $query->bindParam(':reservationId', $reservationId);
        $query->bindParam(':username', $username);
        $query->execute();
        return boolval($query->rowCount());
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
        $reservation = $this->getAllBookReservations($reservationId)[0] ?? null;
        if (!isset($reservation)) {
            return null;
        }
        $query = $this->connection->prepare('DELETE FROM bookReservations WHERE id = :reservationId LIMIT 1;');
        $query->bindParam(':reservationId', $reservationId);
        $query->execute();
        return $reservation->getLendingDate();
    }
}
?>