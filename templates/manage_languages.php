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
        <h2>Manage Languages</h2>
        <div>
            <a href="index.php">Add Student</a> |
            <a href="students.php">Students</a> |
            <a href="manage_cities.php">Cities</a> |
            <a href="register.php">Create New User</a>|
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <p style="color:#4cffb4; margin-bottom:12px;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="languageName" placeholder="New language name" required>
        <button type="submit">Add Language</button>
    </form>

    <br>
    <a href="?sort=asc">A → Z</a> | <a href="?sort=desc">Z → A</a>
    <br><br>

    <table>
        <tr>
            <th>Language Name</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($languages as $id => $name): ?>
            <tr>
                <form method="post">
                    <input type="hidden" name="languageID" value="<?= (int)$id ?>">
                    <input type="hidden" name="action" value="update">
                    <td><input type="text" name="languageName" value="<?= htmlspecialchars($name) ?>"></td>
                    <td><button type="submit">Save</button></td>
                    <td>
                        <button type="submit" name="action" value="delete" onclick="return confirm('Delete this language?')">
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
