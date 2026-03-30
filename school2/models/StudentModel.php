<?php

class StudentModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        return $this->pdo
            ->query("SELECT * FROM students ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($class_id, $name, $birth_date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO students (class_id, name, birth_date)VALUES (:class_id, :name, :birth_date)");
        $stmt->execute(['class_id' => $class_id,'name' => $name,'birth_date' => $birth_date]);
    }

    public function update($id, $class_id, $name, $birth_date)
    {
        $stmt = $this->pdo->prepare("UPDATE students SET class_id = :class_id, name = :name, birth_date = :birth_date WHERE id = :id");
        $stmt->execute(['id' => $id,'class_id' => $class_id,'name' => $name,'birth_date' => $birth_date]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    public function getStudentsByClass($classId)
    {
    $stmt = $this->pdo->prepare("
        SELECT s.*,
        AVG(m.mark) as avg_mark
        FROM students s
        LEFT JOIN marks m ON s.id = m.student_id
        WHERE class_id = :id
        GROUP BY s.id
    ");

    $stmt->execute(["id"=>$classId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
