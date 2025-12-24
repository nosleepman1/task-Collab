<?php 


    class Database {

        private static ?PDO $pdo = null;

        private function __construct() { }

        public static function getInstance() {

            if (!self::$pdo) {

                $host = $_ENV['DB_HOST'];
                $port = $_ENV['DB_PORT'];
                $db   = $_ENV['DB_NAME'];
                $user = $_ENV['DB_USER'];
                $pass = $_ENV['DB_PASS'];

                $dsn = "mysql:host=$host;port=$port;dbname=$db";

                self::$pdo = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);

            }
            
            return self::$pdo;
        }

    }