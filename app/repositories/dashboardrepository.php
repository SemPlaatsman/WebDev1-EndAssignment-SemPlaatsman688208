<?php
require __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/bookreservation.php';

class DashboardRepository extends Repository {
    public function getDashboardCards() : array {
        $query = $this->connection->prepare('SELECT SUM(bookStatus = 0) as "nrToBeReserved", SUM(bookStatus = 1) as "nrReserved", SUM(bookStatus = 2) as "nrLendOut", ' .
                                            'SUM(bookStatus = 2 && lendingDate <= DATE_ADD(NOW(), INTERVAL -1 MONTH)) AS "nrLate" FROM bookReservations;');
        $query->execute();
        $dashboardCards = $query->fetchAll(PDO::FETCH_ASSOC)[0] ?? null;
        return $dashboardCards;
    }

    public function getAllBookReservations() : array {
        $query = $this->connection->prepare('SELECT id, bookId, bookThumbnail, bookTitle, userId, lendingDate, bookStatus FROM bookReservations;');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'BookReservation');

        // rowMapper based on this stackoverflow post: https://stackoverflow.com/questions/12368035/pdo-fetch-class-pass-results-to-constructor-as-parameters
        function rowMapper($id, $bookId, $bookThumbnail, $bookTitle, $userId, $lendingDate, $bookStatus) {
            return new BookReservation($id, $bookId, $bookThumbnail, $bookTitle, $userId, $lendingDate, $bookStatus);
        }
        $bookReservations = $query->fetchAll(PDO::FETCH_FUNC, 'rowMapper');
        return $bookReservations;
    }

    public function getDashboardData() : array {
        $dashboardData = $this->getDashboardCards();
        $bookReservations =  $this->getAllBookReservations();
        $dashboardData += ['bookReservations' => $bookReservations];
        return $dashboardData;
    }

    public function completeReservation(int $reservationId) : bool {
        $query = $this->connection->prepare('UPDATE bookReservations SET bookStatus = 1 WHERE id = :reservationId LIMIT 1');
        $query->bindParam(":reservationId", $reservationId);
        $query->execute();
        return boolval($query->rowCount());
    }
}
?>