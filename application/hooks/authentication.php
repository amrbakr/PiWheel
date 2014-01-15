<?php
class Hooks {
    var $CI;

    function Hooks() {
        $this->CI =&get_instance();
    }
    
    function session_check() {
    	// echo '<pre>';
    	// var_dump($this->CI);
    	// echo '</pre>';
    if(!isset($this->CI->session->userdata['loggedIn'])){
    	
    }
}

}

?> 