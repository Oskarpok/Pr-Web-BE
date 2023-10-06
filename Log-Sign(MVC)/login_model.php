<?php

declare(strict_types=1);

function get_user(object $pdo, string $username){
    $query = $pdo->prepare("SELECT*FROM users WHERE username=:username;");
    $query->bindValue(':username', $username);         
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}