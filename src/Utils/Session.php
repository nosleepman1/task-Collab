<?php 

    namespace App\Utils;

    class Session {

        public static function start() {
            if(session_status() == PHP_SESSION_NONE){
                session_start();
                session_regenerate_id(true);
            }
        
        }

        public static function destroy() {
            self::start();
            $_SESSION = [];

            session_unset();
            session_destroy();
        }


        public static function set($key, $value) {
            self::start();
            $_SESSION[$key] = $value;
        }

        public static function get($key, $default = null) {
            self::start();
            return $_SESSION[$key] ?? $default;
        }

        public static function remove($key) {
            self::start();
            unset($_SESSION[$key]);
        }

        public static function has(string $key) {
            self::start();
            return isset($_SESSION[$key]);
        }

        public static function regenerate() {
            self::start();
            session_regenerate_id(true);
        }

        public static function flash($message, $type = 'success') {
            self::start();
            $_SESSION['flash'][$type] = $message;
        }

        public static function getFlash(string $type) {
            self::start();
            if(isset($_SESSION['flash'][$type])) {
                $message = $_SESSION['flash'][$type];
                unset($_SESSION['flash'][$type]);
                return $message;
            }
            return null;
        }
    }




        


        