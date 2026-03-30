<?php
require_once "models/StudentModel.php";
require_once "views/StudentView.php";

class StudentController
{
    private StudentModel $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new StudentModel($pdo);
    }

    public function handleRequest(string $view)
    {
        // --- POST műveletek ---
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->model->create($_POST['class_id'],$_POST['name'],$_POST['birth_date']);

            if (isset($_POST['update-student'])) {
                $this->model->update($_POST['id'],$_POST['class_id'],$_POST['name'],$_POST['birth_date']);
                header("Location: index.php?view=students");
                exit;
            }
        }

        // --- GET törlés ---
        if (isset($_GET['delete'])) {
            $this->model->delete($_GET['delete']);
            header("Location: index.php?view=students");
            exit;
        }

        // --- Nézetek ---
        switch ($view) {

            case 'students':
                $students = $this->model->getAll();
                StudentView::list($students);
                break;

            case 'add-student':
                StudentView::addForm();
                break;

            case 'edit-student':
                $student = $this->model->find($_GET['id']);
                StudentView::editForm($student);
                break;
        }
    }
}
