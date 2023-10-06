<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];

    try{
        require_once 'include.php';
        require_once 'signup_model.php';
        require_once 'signup_contr.php';

        //ERROR HANDLERS
        $errors = [];

        if(is_input_empty($username, $pwd, $email))
            $errors["empty_input"]="Fill all fields !";
        
        if(is_email_invalid($email))
            $errors["invalid_email"]="Invalid email used !";
        
        if(is_username_taken($pdo,$username))
            $errors["username_taken"]="User already taken !";
        
        if(is_email_registered($pdo, $email))
            $errors["email_used"]="Email alredy registered !";
        
        require_once 'config_sesion.php';
        
        if($errors){
            $_SESSION['errors_signup'] = $errors;
            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION['signup_data'] = $signupData;

            header('Location:index.php');
            die();
        }

        create_user($pdo, $username, $pwd, $email);
        $_SESSION['sign'] = 'success';
        header('Location:index.php');
        $pdo = null;
        $query = null;
        die();
    }

    catch(PDOException $e){
        die("Query failed".$e->getMessage());
    }
}

else{
    header('Location:index.php');
    die();
}