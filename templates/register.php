<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="templates/style.css">
</head>
<body>
    
<div class="page-center">
    <div class="login-box">
        <h2>Create New User</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" required autocomplete="username">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <input type="password" name="confirm" placeholder="Confirm Password" required autocomplete="new-password">
            <button type="submit">Create User</button>
        </form>

        <br>
        <a href="login.php">← Back to Login</a>
    </div>
</div>

</body>
</html>