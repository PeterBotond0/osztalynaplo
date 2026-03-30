<?php
 
class MaintenanceView
{
    public static function menu()
    {
        echo <<<HTML
            <h1>Karbantartás</h1>
 
            <form method="post" action="index.php?view=generate-data">
                <button type="submit">Adatok generálása</button>
            </form>
 
            <br>
 
            <form method="post" action="index.php?view=delete-data"
                  onsubmit="return confirm('Biztos törölni szeretnéd az ÖSSZES adatot?');">
                <button type="submit">Összes adat törlése</button>
            </form>
 
            <hr>
 
            <h2>Adattáblák kezelése</h2>
 
            <ul>
                <li><a href="index.php?view=classes">Osztályok</a></li>
                <li><a href="index.php?view=students">Diákok</a></li>
                <li><a href="index.php?view=subjects">Tantárgyak</a></li>
                <li><a href="index.php?view=marks">Jegyek</a></li>
            </ul>
        HTML;
    }
 
    public static function message($msg)
    {
        echo "<p>$msg</p>";
        echo '<a href="index.php?view=maintenance">Vissza</a>';
    }
}
?>