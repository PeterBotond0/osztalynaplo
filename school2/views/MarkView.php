<?php

class MarkView
{
    public static function list($marks)
    {
        echo <<<HTML
            <h1>Osztályzatok</h1>

            <p><a href="index.php?view=add-mark">Új osztályzat hozzáadása</a></p>

            <table border="1" cellpadding="5">
                <tr>
                    <th>ID</th>
                    <th>Subject ID</th>
                    <th>Osztályzat</th>
                    <th>Student ID</th>
                    <th>Dátum</th>
                </tr>
        HTML;

        foreach ($marks as $m) {
            $id = $m['id'];
            $subject_id = $m['subject_id'];
            $mark = htmlspecialchars($m['mark'], ENT_QUOTES, 'UTF-8');
            $student_id = $m['student_id'];
            $date = htmlspecialchars($m['date'], ENT_QUOTES, 'UTF-8');

            echo <<<HTML
                <tr>
                    <td>{$id}</td>
                    <td>{$subject_id}</td>
                    <td>{$mark}</td>
                    <td>{$student_id}</td>
                    <td>{$date}</td>
                    <td>
                        <a href="index.php?view=edit-mark&id={$id}">Módosítás</a> |
                        <a href="index.php?view=marks&delete={$id}"
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
            <h1>Új osztályzat hozzáadása</h1>

            <form method="post" action="index.php?view=marks">
                <label>Subject ID:</label><br>
                <input type="number" name="subject_id"><br><br>
                <label>Osztályzat:</label><br>
                <input type="number" name="mark"><br><br>
                <label>Student ID:</label><br>
                <input type="number" name="student_id"><br><br>
                <label>Dátum:</label><br>
                <input type="date" name="date"><br><br>

                <button type="submit" name="add-mark">Hozzáadás</button>
                <a href="index.php?view=marks">Mégse</a>
            </form>
        HTML;
    }

    public static function editForm($m)
    {
        $id = $m['id'];
        $subject_id = $m['subject_id'];
        $mark = htmlspecialchars($m['mark'], ENT_QUOTES, 'UTF-8');
        $student_id = $m['student_id'];
        $date = $m['date'] === '0000-00-00' ? '' : htmlspecialchars($m['date'], ENT_QUOTES, 'UTF-8');

        echo <<<HTML
            <h1>Osztályzat módosítása</h1>

            <form method="post" action="index.php?view=marks">
                <input type="hidden" name="id" value="{$id}">

                <label>Subject ID:</label><br>
                <input type="number" name="subject_id" value="{$subject_id}"><br><br>

                <label>Osztályzat:</label><br>
                <input type="number" name="mark" value="{$mark}"><br><br>

                <label>Student ID:</label><br>
                <input type="number" name="student_id" value="{$student_id}"><br><br>

                <label>Dátum:</label><br>
                <input type="date" name="date" value="{$date}"><br><br>

                <button type="submit" name="update-mark">Mentés</button>
                <a href="index.php?view=marks">Mégse</a>
            </form>
        HTML;
    }
}
