<?php

class MarkModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        return $this->pdo
            ->query("SELECT * FROM Marks ORDER BY id DESC, mark ASC, date ASC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Marks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($subject_id, $mark, $student_id, $date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Marks (subject_id, mark, student_id, date) VALUES (:subject_id, :mark, :student_id, :date)");

        $stmt->execute(['subject_id' => $subject_id, 'mark' => $mark, 'student_id' => $student_id, 'date' => $date]);
    }

    public function update($id, $subject_id, $mark, $student_id, $date)
    {
        $stmt = $this->pdo->prepare("UPDATE Marks SET subject_id = :subject_id, mark = :mark, student_id = :student_id, date = :date WHERE id = :id");
        $stmt->execute(['subject_id' => $subject_id,'mark' => $mark,'student_id' => $student_id,'date' => $date,'id' => $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Marks WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
