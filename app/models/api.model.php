<?php
    class Model {
        protected $db;

        function __construct() {
          $this->db = new PDO('mysql:host='. HOST .';dbname='. NAME .';charset=utf8', USER, PASSWORD);
        }
        
    }