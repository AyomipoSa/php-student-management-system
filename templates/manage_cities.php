<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="templates/style.css">
</head>
<body>
    

<div class="card">
    <div class="topbar">
        <h2>Manage Cities</h2>
        <div>
            <a href="index.php">Add Student</a> |
            <a href="students.php">Students</a> |
            <a href="manage_languages.php">Languages</a> |
            <a href="register.php">Create New User</a>|
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <p style="color:#4cffb4; margin-bottom:12px;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="cityName" placeholder="New city name" required>
        <button type="submit">Add City</button>
    </form>

    <br>
    <a href="?sort=asc">A → Z</a> | <a href="?sort=desc">Z → A</a>
    <br><br>

    <table>
        <tr>
            <th>City Name</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($cities as $id => $name): ?>
            <tr>
                <form method="post">
                    <input type="hidden" name="cityID" value="<?= (int)$id ?>">
                    <input type="hidden" name="action" value="update">
                    <td><input type="text" name="cityName" value="<?= htmlspecialchars($name) ?>"></td>
                    <td><button type="submit">Save</button></td>
                    <td>
                        <button type="submit" name="action" value="delete" onclick="return confirm('Delete this city?')">
                            Delete
                        </button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>