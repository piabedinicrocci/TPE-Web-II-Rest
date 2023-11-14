<?php
require_once 'app/views/api.responseHandler.php';
    
abstract class ApiController {
    protected $view;
    private $data;
    
    function __construct() {
        $this->view = new ApiResponseHandler();
        $this->data = file_get_contents('php://input');
    }

    function getData() {
        return json_decode($this->data);
    }
}