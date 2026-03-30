<?php
 
require_once "views/MaintenanceView.php";
require_once "controllers/Install.php";
 
class MaintenanceController
{
    private PDO $pdo;
 
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
 
    public function handleRequest(string $view)
    {
        switch ($view) {
 
            case "maintenance":
                MaintenanceView::menu();
                break;
 
            case "generate-data":
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $install = new Install($this->pdo);
                    $install->generate();
                    MaintenanceView::message("Adatok sikeresen generálva!");
                }
                break;
                case "delete-data":
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $install = new Install($this->pdo);
                        $install->deleteAll();
                        MaintenanceView::message("Minden adat törölve!");
                    }
                    break;
        }
    }
}