<?php

namespace ponbiki\apiCheat;

class Session implements  iSession
{
    public function __construct()
    {
        ini_set('session.use_only_cookies', true);
        session_start();
        if (!isset($_SESSION['generated']) || $_SESSION['generated'] < (time() - 30)) {
            session_regenerate_id();
            $_SESSION['generated'] = time();
        }
    }
    
    public static function logout()
    {
        if (isset($_SESSION['api_key'])) {
            if (session_id() != "" || isset ($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 2592000, '/');
            }
            session_destroy();
            unset($_SESSION['api_key']);
        }
    }
    
    public static function clear()
    {
        unset($_SESSION['error']);
        unset($_SESSION['info']);
    }
}
