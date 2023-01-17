<?php
class Book implements JsonSerializable {
    private string $id;
    private string $title;
    private string $subtitle;
    /**
     * @var string[]
     */
    private array $authors;
    // unknown date format provided by api so DateTime object in unreliable
    private string $publishedDate;
    private string $description;
    private int $pageCount;
    /**
     * @var string[]
     */
    private array $categories;
    private string $smallThumbnail;
    // language in two-letter ISO-639-1 code
    private string $language;
    private string $textSnippet;

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    function __construct(string $id, string $title, string $subtitle, array $authors, string $publishedDate, string $description, int $pageCount, array $categories, string $smallThumbnail, string $language, string $textSnippet) {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->authors = $authors;
        $this->publishedDate = $publishedDate;
        $this->description = $description;
        $this->pageCount = $pageCount;
        $this->categories = $categories;
        $this->smallThumbnail = $smallThumbnail;
        $this->language = $language;
        $this->textSnippet = $textSnippet;
    }

    /**
     * Get the value of id
     * 
     * @return string
     */ 
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * Get the value of title
     * 
     * @return string
     */ 
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Get the value of subtitle
     * 
     * @return string
     */ 
    public function getSubtitle() : string
    {
        return $this->subtitle;
    }

    /**
     * Get the value of authors
     *
     * @return string[]
     */ 
    public function getAuthors() : array
    {
        return $this->authors;
    }

    /**
     * Get the value of publishedDate
     * 
     * @return string
     */ 
    public function getPublishedDate() : string
    {
        return $this->publishedDate;
    }

    
    /**
     * Get the value of description
     * 
     * @return string
     */ 
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Get the value of pageCount
     * 
     * @return int
     */ 
    public function getPageCount() : int
    {
        return $this->pageCount;
    }

    /**
     * Get the value of categories
     *
     * @return string[]
     */ 
    public function getCategories() : array
    {
        return $this->categories;
    }

    /**
     * Get the value of smallThumbnail
     * 
     * @return string
     */ 
    public function getSmallThumbnail() : string
    {
        return $this->smallThumbnail;
    }

    /**
     * Get the value of language
     * 
     * @return string
     */ 
    public function getLanguage() : string
    {
        return $this->language;
    }

    /**
     * Get the value of textSnippet
     * 
     * @return string
     */ 
    public function getTextSnippet() : string
    {
        return $this->textSnippet;
    }
}
?>