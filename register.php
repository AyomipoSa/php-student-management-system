<?php

session_start();

$error = $_SESSION['register_error'] ?? '';
unset($_SESSION['register_error']);

$success = $_SESSION['register_success'] ?? '';
unset($_SESSION['register_success']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="templates/style.css">
    <title>Create New User</title>
</head>

<body>

    <div class="page-center">

        <div class="login-box">

            <h2>Create New User</h2>

            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <?php if ($success): ?>
                <p class="success"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <form action="register_process.php" method="post">

                <input type="text" name="username" placeholder="Username" required>

                <input type="password" name="password" placeholder="Password" required>

                <input type="password" name="confirm" placeholder="Confirm Password" required>

                <button type="submit">
                    Create User
                </button>

            </form>

            <br>

            <a href="login.php">
                Back to Login
            </a>

        </div>

    </div>

</body>

</html>