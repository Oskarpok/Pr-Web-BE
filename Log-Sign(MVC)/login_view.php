<?php

declare(strict_types=1);

function check_login_errors(){
    if(isset($_SESSION['errors_login'])){
        $errors = $_SESSION['errors_login'];
        unset($_SESSION['errors_login']);

        foreach($errors as $error){
            echo '<p class="errors_login">'.$error.'</p>';
        }
    }

    elseif(isset($_SESSION['login']) && $_SESSION['login'] === 'sukces'){
        echo '<br><p class="succesreg">You logged in correct</p>';
        unset($_SESSION['login']);
    }
}

function output_username(){
    if(isset($_SESSION["log_id"]))
        echo "You are looged in as ".$_SESSION["log_username"];
        
    else
        echo "You are not looged in";
}