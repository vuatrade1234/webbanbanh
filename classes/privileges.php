<?php
class privileges{
    function checkPrivileges($uri = false){
        $uri = $uri != false ? $uri :  $_SERVER['REQUEST_URI'];
        if (isset($_SESSION['current_user']['privileges']) && !empty($_SESSION['current_user']['privileges'])) {
            $privileges = $_SESSION['current_user']['privileges'];
            $privileges = implode("|", $privileges);
            preg_match('/'.$privileges.'/', $uri, $matches);
            return !empty($matches);
        } else {
            return false;
        }
    }
}
?>