<?php
namespace Controllers;

class MainController
{
    public function index()
    {
        session_start();

        $pdo = new \PDO('mysql:host=localhost;dbname=finder', 'root', 'password');

        // Determine protocol
//        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

        // Hostname (example.com)
//        $host = $_SERVER['HTTP_HOST'];

        // Path and query string (/path/page.php?foo=bar)
        $requestUri = $_SERVER['REQUEST_URI'];

        // Full URL
        $currentUrl = $requestUri;

        echo $currentUrl;

        if (isset($_SESSION['user_id'])) {
            echo "Logged in";
        } else {
            echo "Not logged in";
        }
    }
}