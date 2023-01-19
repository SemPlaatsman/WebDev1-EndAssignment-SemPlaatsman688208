<?php
require_once __DIR__ . '/apicontroller.php';
require_once __DIR__ . '/../../models/book.php';
require_once __DIR__ . '/../../services/booksservice.php';

class BooksController extends APIController {
    private $booksService;

    function __construct() {
        $this->booksService = new BooksService();
    }

    public function reserveBook(int $bookId, string $smallThumbnail, string $title, int $userId) : bool {
        return $this->booksService->reserveBook($bookId, $smallThumbnail, $title, $userId);
    }

    public function index() {
        $model = [];

        // no error reporting to stop warnings
        // error reporting will be activated again afterwards
        error_reporting(E_ERROR | E_PARSE);
        try {
            if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
                $this->handlePOST($model);
            }
            // if statement without check for server request method because 
            // a get request will also be handled when a post request is sent
            if (!empty($_GET)) {
                $this->handleGET($model);
            } else {
                $data = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=code&printType=books&maxResults=21&fields=items(id,volumeInfo(title,subtitle,authors,publishedDate,description,pageCount,categories,imageLinks(smallThumbnail),language),searchInfo(textSnippet))&key=AIzaSyCS3vUD0Yc_H5iHextoznZKfLsrzvbeiuM");
                $data = json_decode($data);
                foreach ($data->items as $bookData) {
                    $book = $this->dataToBook($bookData, true);
                    if ($book == null) {
                        continue;
                    }
                    array_push($model, $book);
                }
            }
        } catch (Exception | Error $ex) { }
        error_reporting(E_ALL);

        $this->displayView($model);
    }

    /**
     * Handle GET request
     * 
     * paramater passed by reference so it doesn't need a return type
     * @param &$model
     * 
     */
    private function handleGET(&$model) {
        // filter GET
        $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // get one book by id
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $data = file_get_contents("https://www.googleapis.com/books/v1/volumes/" . $_GET['id'] . "?maxResults=1&fields=id,volumeInfo(title,subtitle,authors,publishedDate,description,pageCount,categories,imageLinks(smallThumbnail),language),searchInfo(textSnippet)&key=AIzaSyCS3vUD0Yc_H5iHextoznZKfLsrzvbeiuM");
            $data = json_decode($data);
            $book = $this->dataToBook($data, false);
            array_push($model, $book);
        } 
        // get books by search query
        else if (isset($_GET['search']) && !empty($_GET['search'])) {
            $searchQuery = str_replace(' ', '%20', $_GET['search']);
            $data = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=' . $searchQuery . '&printType=books&maxResults=21&fields=items(id,volumeInfo(title,subtitle,authors,publishedDate,description,pageCount,categories,imageLinks(smallThumbnail),language),searchInfo(textSnippet))&key=AIzaSyCS3vUD0Yc_H5iHextoznZKfLsrzvbeiuM');
            $data = json_decode($data);
            foreach ($data->items as $bookData) {
                $book = $this->dataToBook($bookData, false);
                if ($book == null) {
                    continue;
                }
                array_push($model, $book);
            }
        }
    }

    /**
     * Handle POST request
     * 
     * @param &$model
     */
    private function handlePOST(&$model) {
        // filter POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // start session if it hasn't been started yet
        (session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED) ? session_start() : null;
        // reservate book
        if (isset($_POST['bookReservationId']) && isset($_POST['bookReservationThumbnail']) && isset($_POST['bookReservationTitle']) && isset($_SESSION['user'])
        && !empty($_POST['bookReservationId']) && !empty($_POST['bookReservationThumbnail']) && !empty($_POST['bookReservationTitle']) && !empty($_SESSION['user'])) {
            $_POST['bookReservationThumbnail'] = htmlspecialchars_decode($_POST['bookReservationThumbnail']);
            $this->booksService->reserveBook($_POST['bookReservationId'], $_POST['bookReservationThumbnail'], $_POST['bookReservationTitle'], unserialize($_SESSION['user'])->getId());
        }
    }

    /**
     * Convert API data to Book object
     * 
     * @param object $bookData
     * @param bool $stripTags
     * 
     * @return ?Book
     */
    private function dataToBook(object $bookData, bool $stripTags) : ?Book {
        // get nested arrays from API
        $volumeInfo = $bookData->volumeInfo;
        $imageLinks = $volumeInfo->imageLinks;
        $textSnippet = property_exists($bookData, 'searchInfo') ? 
            (property_exists($bookData->searchInfo, 'textSnippet') 
                ? $bookData->searchInfo->textSnippet 
                : "Text snippet unavailable") 
            : "Text snippet unavailable";

        if (!property_exists($bookData, 'id')) {
            return null;
        }

        $book = new Book($bookData->id,
            $volumeInfo->title ?? "Unknown title",
            $volumeInfo->subtitle ?? "",
            $volumeInfo->authors ?? ["Unkown authors"],
            $volumeInfo->publishedDate ?? "Unknown date",
            property_exists($volumeInfo, 'description') ? strip_tags($volumeInfo->description) : "No description",
            $volumeInfo->pageCount ?? 0,
            $volumeInfo->categories ?? ["Unknown category"],
            $imageLinks->smallThumbnail ?? "/img/png/coverunavailable.png",
            property_exists($volumeInfo, 'language') ? strtoupper($volumeInfo->language) : "Language unknown",
            $stripTags ? strip_tags($textSnippet) : $textSnippet);
        
        return $book;
    }
}
?>