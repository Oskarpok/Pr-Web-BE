<?php
    require_once 'config_sesion.php';
    require_once 'signup_view.php';
    require_once 'login_view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        output_username();
    ?>

    <?php   
        if(!isset($_SESSION["log_id"])) { ?>
            <h3>Log in</h3>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="pwd" placeholder="Password">
                <button>Login</button>
            </form>
    <?php } ?>

    <?php
        check_login_errors();
    ?>
    
    <h3>Signup</h3>

    <form action="signup.php" method="post">
        <?php signup_inuts(); ?>
        <button>Signup</button>
    </form>

    <?php
        check_signup_errors();
    ?>

    <?php
        if(isset($_SESSION["log_id"])) { ?>
    
        <h3>Log out</h3>
        <form action="logout.php" method="get">
            <button>Log out</button>
        </form>
    <?php } ?>

</body>
</html>