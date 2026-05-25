
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="templates/style.css">
</head>
<body>
    
<div class="form-card">
    <div class="topbar">
        <h2>Add New Student</h2>
        <div>
            <a href="students.php">View Students</a> |
            <a href="manage_cities.php">Cities</a> |
            <a href="manage_languages.php">Languages</a> |
            <a href="register.php">Create New User</a>|
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <form method="post">
        <label for="fname">First Name *</label>
        <?php if (isset($error['name'])): ?>
            <span class="error-msg"><?= htmlspecialchars($error['name']) ?></span>
        <?php endif; ?>
        <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($name) ?>" required>

        <label for="lname">Last Name *</label>
        <?php if (isset($error['surname'])): ?>
            <span class="error-msg"><?= htmlspecialchars($error['surname']) ?></span>
        <?php endif; ?>
        <input type="text" id="lname" name="lname" value="<?= htmlspecialchars($surname) ?>" required>

        <label for="cityID">City *</label>
        <?php if (isset($error['city'])): ?>
            <span class="error-msg"><?= htmlspecialchars($error['city']) ?></span>
        <?php endif; ?>
        <select name="cityID" id="cityID" required>
            <option value="">Select City</option>
            <?php foreach ($cities as $cityID => $cityName): ?>
                <option value="<?= (int)$cityID ?>" <?= ((string)$city === (string)$cityID) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cityName) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">

        <label>Gender</label>
        <div class="radio-group">
            <label><input type="radio" name="gender" value="m" <?= ($gender === 'm') ? 'checked' : '' ?>> Male</label>
            <label><input type="radio" name="gender" value="f" <?= ($gender === 'f') ? 'checked' : '' ?>> Female</label>
            <label><input type="radio" name="gender" value="o" <?= ($gender === 'o') ? 'checked' : '' ?>> Other</label>
        </div>

        <label>Languages</label>
        <div class="checkbox-group">
            <?php foreach ($languages as $language_id => $language_name): ?>
                <label>
                    <input type="checkbox" name="languages[]" value="<?= (int)$language_id ?>">
                    <?= htmlspecialchars($language_name) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit">Add Student</button>
    </form>
</div>
</body>
</html>
