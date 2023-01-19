<?php
class APIController {
    function displayView($model = []) {        
        $directory = strtolower(substr(get_class($this), 0, -10));
        $view = strtolower(debug_backtrace()[1]['function']);
        require __DIR__ . "/../../views/$directory/$view.php";
    }
}