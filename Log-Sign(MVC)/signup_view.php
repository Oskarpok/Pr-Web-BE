<?php

declare(strict_types=1);

function signup_inuts(){

    if(isset($_SESSION['signup_data']['username']) && !isset($_SESSION['errors_signup']['username_taken'])){
        echo '<input type="text" name="username" placeholder="Username" value="'.$_SESSION['signup_data']['username'].'">';
        unset($_SESSION['signup_data']['username']);
    }

    else echo '<input type="text" name="username" placeholder="Username">';

    echo '<input type="password" name="pwd" placeholder="Password">'; 

    if(isset($_SESSION['signup_data']['email']) && !isset($_SESSION['errors_signup']['invalid_email']) && !isset($_SESSION['errors_signup']['email_used'])){
        echo '<input type="text" name="email" placeholder="E-mail" value="'.$_SESSION['signup_data']['email'].'">';
        unset($_SESSION['signup_data']['email']);
    }

    else echo '<input type="text" name="email" placeholder="E-mail">';
}

function check_signup_errors(){

    if(isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];
        unset($_SESSION['errors_signup']); 

        echo "<br>";

        foreach($errors as $error){
            echo '<p class="errors_signup">'.$error.'</p>';
        }
    }

    else if(isset($_SESSION['sign']) && $_SESSION['sign'] === 'success' ){
        echo '<br>';
        echo '<p class="succesreg">You signup successfuly</p>';
        unset($_SESSION['sign']);
    }
}