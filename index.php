<?php

declare(strict_types=1);

require_once 'classes/Student.php';
require_once 'classes/School.php';
require_once 'classroom-data.php';

$school = new School(DATA);

$view = $_GET['view'] ?? 'all';
$class = $_GET['class'] ?? null;

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Iskolanévsor</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h1>Iskolanévsor</h1>

<nav>
    <a href="?view=all">Teljes névsor</a>
    <?php foreach (DATA['classes'] as $c): ?>
        | <a href="?view=class&class=<?= $c ?>"><?= $c ?></a>
    <?php endforeach; ?>
</nav>

<hr>

<?php
if ($view === 'class' && $class) {
    $students = $school->getStudentsByClass($class);
    echo "<h2>{$class} osztály</h2>";
} else {
    $students = $school->getAllStudents();
    echo "<h2>Teljes iskolanévsor</h2>";
}
?>

<ul>
    <?php foreach ($students as $student): ?>
        <li>
            <strong><?= $student->getName() ?></strong>
            (<?= $student->getClass() ?>, <?= $student->getGender() ?>)

            <ul>
                <?php foreach ($student->getGrades() as $subject => $grades): ?>
                    <li>
                        <?= $subject ?>:
                        <?= empty($grades) ? 'nincs jegy' : implode(', ', $grades) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
