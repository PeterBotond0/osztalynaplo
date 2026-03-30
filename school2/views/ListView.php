<?php
require_once "LayoutView.php";

class ListView
{
    public static function render($classes, $students)
    {


        echo "<h2>Osztály kiválasztása</h2>";

        foreach ($classes as $c) {
            echo "<a href='index.php?view=lists&class_id={$c["id"]}'>
            {$c["grade"]}{$c["letter"]}
            </a><br>";
        }

        if ($students) {

            echo "<h2>Tanulók</h2>";

            echo "<table border=1>";
            echo "<tr><th>Név</th><th>Átlag</th></tr>";

            foreach ($students as $s) {
                echo "<tr>";
                echo "<td>{$s["name"]}</td>";
                echo "<td>".round($s["avg_mark"],2)."</td>";
                echo "</tr>";
            }

            echo "</table>";
        }

        LayoutView::footer();
    }
}