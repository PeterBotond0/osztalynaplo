<?php
require_once "views/LayoutView.php";
require_once "views/HomeView.php";
require_once "views/ClassView.php";
require_once "views/StudentView.php";
require_once "views/SubjectView.php";
require_once "views/MarkView.php";
require_once "models/SubjectModel.php";
require_once "models/StudentModel.php";
require_once "models/ClassModel.php";
require_once "models/MarkModel.php";
require_once "controllers/SubjectController.php";
require_once "controllers/ClassController.php";
require_once "controllers/StudentController.php";
require_once "controllers/MarkController.php";
require_once "controllers/MaintenanceController.php";
require_once "controllers/Router.php";
require_once "controllers/Install.php";

$pdo = new PDO("mysql:host=localhost;dbname=av_school;charset=utf8", "root", "");

$view = $_GET['view'] ?? 'home';
$router = new Router($pdo);

LayoutView::head();
LayoutView::menu();

$router->handle($view);

LayoutView::footer();
