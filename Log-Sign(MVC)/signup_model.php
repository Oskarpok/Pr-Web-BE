<?php

declare(strict_types=1);

function get_username(object $pdo, string $username){
    $query = $pdo->prepare("SELECT username FROM users WHERE username=:username;");
    $query->bindValue(':username', $username);         
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email){
    $query = $pdo->prepare("SELECT email FROM users WHERE email=:email;");
    $query->bindValue(':email', $email);         
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $username, string $pwd, string $email){
    $query = $pdo->prepare("INSERT INTO users (username, pwd, email) VALUES(:username, :pwd, :email)");

    $options = ['cost' => 12];
    $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $query->bindValue(':username', $username);
    $query->bindValue(':pwd', $hashedpwd);
    $query->bindValue(':email', $email);         
    $query->execute();
}