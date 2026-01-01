<?php
namespace Controllers;

class MainController
{
    public function index()
    {
        require_once __DIR__ . "/../views/portfolio.php";
    }
}