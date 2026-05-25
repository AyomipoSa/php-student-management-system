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
        <h2>Students</h2>
        <div>
            <a href="index.php">Add Student</a> |
            <a href="manage_cities.php">Cities</a> |
            <a href="manage_languages.php">Languages</a> |
            <a href="register.php">Create New User</a> |
            <a href="export_students.php">Export to Excel</a>|
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <form method="get" style="margin-bottom: 18px; display: flex; gap: 10px; flex-wrap: wrap;">
        <input
            type="text"
            name="search"
            placeholder="Search by first name, surname, phone, email or city"
            value="<?= htmlspecialchars($search ?? '') ?>"
        >
        <button type="submit">Search</button>
        <a href="students.php">Reset</a>
    </form>

    <?php if (!empty($students)): ?>
        <table>
            <tr>
                <th>Name &amp; Surname</th>
                <th>City</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($students as $student): ?>
                <tr>
                    <td>
                        <a href="student.php?id=<?= (int)$student['studentID'] ?>">
                            <?= htmlspecialchars($student['studentName'] . ' ' . $student['studentSurname']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($student['cityName'] ?? '—') ?></td>
                    <td>
                        <a href="edit_students.php?id=<?= (int)$student['studentID'] ?>">Edit</a> |
                        <a href="delete.php?id=<?= (int)$student['studentID'] ?>" onclick="return confirm('Delete this student?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="pagination" style="margin-top: 18px;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?<?= http_build_query(['search' => $search ?? '', 'page' => $i]) ?>"
                   style="padding: 8px 12px; border: 1px solid rgba(140,170,255,0.22); border-radius: 10px; <?= $i === $page ? 'background:#7c5cff;color:#fff;' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <p>No students found.</p>
    <?php endif; ?>
</div>

</body>
</html>