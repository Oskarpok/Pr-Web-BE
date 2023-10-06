<?php

ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',    
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

if(isset($_SESSION['log_id'])){

    if(!isset($_SESSION['last_regeneration'])) 
        regeneration_sesion_id_loggedin();

    else{
        $interval = 60*30;
        if(time() - $_SESSION['last_regeneration'] >= $interval)
            regeneration_sesion_id_loggedin();
    
    }
}

else{

    if(!isset($_SESSION['last_regeneration'])) 
        regeneration_sesion_id();

    else{
        $interval = 60*30;
        if(time() - $_SESSION['last_regeneration'] >= $interval)
            regeneration_sesion_id();
    }

}

function regeneration_sesion_id(){  
    $usId = $_SESSION["log_id"]; 
    $newSessionId = session_create_id();
    $sesionID = $newSessionId."_". $usId;
    session_id($sesionID);
    $_SESSION['last_regeneration'] = time();
}

function regeneration_sesion_id_loggedin(){
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}