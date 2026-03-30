<?php

class StudentView
{
    public static function list($students)
    {
        echo <<<HTML
            <h1>Tanulók</h1>

            <p><a href="index.php?view=add-student">Új tanuló hozzáadása</a></p>

            <table border="1" cellpadding="5">
                <tr>
                    <th>ID</th>
                    <th>Class ID</th>
                    <th>Név</th>
                    <th>Születési idő</th>
                </tr>
        HTML;
        foreach ($students as $s) {
            $id = $s['id'];
            $class_id = $s['class_id'];
            $name = htmlspecialchars($s['name'], ENT_QUOTES, 'UTF-8');
            $birth_date = htmlspecialchars($s['birth_date'], ENT_QUOTES, 'UTF-8');

            echo <<<HTML
                <tr>
                    <td>{$id}</td>
                    <td>{$class_id}</td>
                    <td>{$name}</td>
                    <td>{$birth_date}</td>
                    <td>
                        <a href="index.php?view=edit-student&id={$id}">Módosítás</a> |
                        <a href="index.php?view=students&delete={$id}"
                           onclick="return confirm('Biztos törlöd?')">Törlés</a>
                    </td>
                </tr>
            HTML;
        }

        echo "</table>";
    }

    public static function addForm()
    {
        echo <<<HTML
            <h1>Új tanuló hozzáadása</h1>

            <form method="post" action="index.php?view=students">
                <label>Osztály ID:</label><br>
                <input type="number" name="class_id"><br><br>
                <label>Név:</label><br>
                <input type="text" name="name"><br><br>
                <label>Születési idő:</label><br>
                <input type="date" name="birth_date"><br><br>

                <button type="submit" name="add-student">Hozzáadás</button>
                <a href="index.php?view=students">Mégse</a>
            </form>
        HTML;
    }

    public static function editForm($student)
    {
        $id = $student['id'];
        $class_id = $student['class_id'];
        $name = htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8');
        $birth_date = htmlspecialchars($student['birth_date'], ENT_QUOTES, 'UTF-8');

        echo <<<HTML
            <h1>Tanuló módosítása</h1>

            <form method="post" action="index.php?view=students">
                <input type="hidden" name="id" value="{$id}">

                <label>Class ID:</label><br>
                <input type="number" name="class_id" value="{$class_id}"><br><br>

                <label>Név:</label><br>
                <input type="text" name="name" value="{$name}"><br><br>

                <label>Születési idő:</label><br>
                <input type="date" name="birth_date" value="{$birth_date}"><br><br>

                <button type="submit" name="update-student">Mentés</button>
                <a href="index.php?view=students">Mégse</a>
            </form>
        HTML;
    }
}
