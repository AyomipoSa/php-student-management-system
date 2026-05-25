<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="templates/style.css">
</head>
<body>
    

<div class="student-card">
    <a href="students.php" class="back-link">← Back to Students</a>

    <?php if (!empty($student)): ?>
        <h2><?= htmlspecialchars($student['studentName'] . ' ' . $student['studentSurname']) ?></h2>

        <div class="field">
            <span class="field-label">Student ID:</span>
            <?= htmlspecialchars($student['studentID']) ?>
        </div>

        <div class="field">
            <span class="field-label">City:</span>
            <?= htmlspecialchars($student['cityName'] ?? '—') ?>
        </div>

        <div class="field">
            <span class="field-label">Phone:</span>
            <?= htmlspecialchars($student['studentPhone'] ?? '—') ?>
        </div>

        <div class="field">
            <span class="field-label">Email:</span>
            <?= htmlspecialchars($student['studentEmail'] ?? '—') ?>
        </div>

        <div class="field">
            <span class="field-label">Gender:</span>
            <?php
                $genderMap = ['m' => 'Male', 'f' => 'Female', 'o' => 'Other'];
                echo htmlspecialchars($genderMap[$student['studentGender']] ?? '—');
            ?>
        </div>
    <?php else: ?>
        <p>Student not found.</p>
    <?php endif; ?>
</div>

</body>
</html>