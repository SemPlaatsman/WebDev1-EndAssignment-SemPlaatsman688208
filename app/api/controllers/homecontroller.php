<?php
require __DIR__ . '/apicontroller.php';
require_once __DIR__ . '/../../models/book.php';
// require __DIR__ . '/../../services/homeservice.php';

class HomeController extends Controller {
    private $homeService;

    function __construct() {
        // $this->homeService = new HomeService();
    }

    public function index() {
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Methods: *");
        // header("Access-Control-Allow-Headers: *");

        $data = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=code&printType=books&maxResults=4&fields=items(id,volumeInfo(title,subtitle,authors,publishedDate,pageCount,categories,imageLinks(smallThumbnail),language),searchInfo(textSnippet))&key=AIzaSyCS3vUD0Yc_H5iHextoznZKfLsrzvbeiuM");
        $data = json_decode($data);

        $model = [];
        foreach ($data->items as $bookData) {
            $book = $this->dataToBook($bookData);
            if ($book == null) {
                continue;
            }
            array_push($model, $book);
        }

        $this->displayView($model);
    }

    /**
     * Convert API data to Book object
     * 
     * @param object $bookData
     * 
     * @return ?Book
     */
    private function dataToBook(object $bookData) : ?Book {
        $volumeInfo = $bookData->volumeInfo;
        $imageLinks = $volumeInfo->imageLinks;
        $textSnippet = property_exists($bookData, 'searchInfo') ? 
            (property_exists($bookData->searchInfo, 'textSnippet') 
                ? $bookData->searchInfo->textSnippet 
                : "Text snippet unavailable") 
            : "Text snippet unavailable";
        $textSnippet = strip_tags($textSnippet);
        
        if (!property_exists($bookData, 'id')) {
            return null;
        }

        $book = new Book($bookData->id,
            property_exists($volumeInfo, 'title') ? $volumeInfo->title : "Unknown title",
            property_exists($volumeInfo, 'subtitle') ? $volumeInfo->subtitle : "",
            property_exists($volumeInfo, 'authors') ? $volumeInfo->authors : ["Unkown authors"],
            property_exists($volumeInfo, 'publishedDate') ? $volumeInfo->publishedDate : "Unknown date",
            property_exists($volumeInfo, 'pageCount') ? $volumeInfo->pageCount : 0,
            property_exists($volumeInfo, 'categories') ? $volumeInfo->categories : ["Unknown category"],
            property_exists($imageLinks, 'smallThumbnail') ? $imageLinks->smallThumbnail : "/img/png/coverunavailable.png",
            property_exists($volumeInfo, 'language') ? $volumeInfo->language : "Unknown language",
            $textSnippet);
        return $book;
    }
}
?>