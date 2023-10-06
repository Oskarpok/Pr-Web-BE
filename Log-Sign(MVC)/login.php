<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try{
        require_once 'include.php';
        require_once 'login_model.php';
        require_once 'login_contr.php';

        //ERROR HANDLERS
        $errors = [];

        if(is_input_empty($username, $pwd))
            $errors["empty_input"]="Fill all fields !";
        
        $result = get_user($pdo, $username);

        if(is_username_wrong($result) || $result===null)
            $errors["login_incorrect"]="Incorrect login or password !";
        
        else{
            if(!is_username_wrong($result) && is_password_wrong($pwd, $result['pwd']))
            $errors["login_incorrect"]="Incorrect login or password !";
        }
        
        require_once "config_sesion.php";

        if($errors){
            $_SESSION['errors_login'] = $errors;
            header('Location:index.php');
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId.'_'.$result['id'];
        session_id($sessionId);

        $_SESSION["log_id"] = $result["id"];
        $_SESSION["log_username"] = htmlspecialchars($result["username"]);
        $_SESSION["login"] = "sukces";
        $_SESSION["last_regeneration"] = time();

        $pdo = null;
        $query = null;


        header('Location:index.php');
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