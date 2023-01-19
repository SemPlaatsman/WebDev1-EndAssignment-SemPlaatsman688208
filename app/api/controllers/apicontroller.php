<?php
class APIController {
    /**
     * function to display view from api
     * 
     * @param array $model
     */
    function displayView($model = []) {        
        $directory = strtolower(substr(get_class($this), 0, -10));
        $view = strtolower(debug_backtrace()[1]['function']);
        require_once __DIR__ . "/../../views/$directory/$view.php";
    }
}