<?php

require '../../vendor/autoload.php';

use Dotenv\Dotenv;

$envPath = dirname(__DIR__) . '../../';

$dotenv = Dotenv::createImmutable($envPath);
$dotenv->load();

class conn {
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->database = $_ENV['DB_DATABASE'];
    }

    public function create_connection(){
        $connection = mysqli_connect(
            $this->host, 
            $this->username, 
            $this->password, 
            $this->database
        );

        mysqli_set_charset($connection, 'utf8');

        
        if(mysqli_connect_errno()){
            echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
        }

        return $connection;
    }
}
