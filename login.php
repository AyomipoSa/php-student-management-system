<?php

session_start();

if (!empty($_SESSION['logged'])) {
    header("Location: students.php");
    exit();
}

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="templates/style.css">
    <title>Login</title>
</head>
<body>

<div class="page-center">

    <div class="login-box">

        <h2>Login</h2>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="login_process.php" method="post">

            <input type="text"
                   name="username"
                   placeholder="Username"
                   required>

            <input type="password"
                   name="password"
                   placeholder="Password"
                   required>

            <button type="submit" name="login">
                Login
            </button>

        </form>

        <br>

    </div>

</div>

</body>
</html>