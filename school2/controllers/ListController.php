<?php

require_once "models/ClassModel.php";
require_once "models/StudentModel.php";
require_once "views/ListView.php";

class ListController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleRequest()
    {
        $classModel = new ClassModel($this->pdo);
        $studentModel = new StudentModel($this->pdo);

        $classes = $classModel->getAll();

        $students = [];
        $classId = $_GET["class_id"] ?? null;

        if ($classId) {
            $students = $studentModel->getStudentsByClass($classId);
        }

        ListView::render($classes, $students);
    }
    
}