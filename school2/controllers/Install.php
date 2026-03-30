<?php

class Install
{
    private PDO $pdo;
    public function deleteAll()
{
    $this->pdo->exec("DELETE FROM marks");
    $this->pdo->exec("DELETE FROM students");
    $this->pdo->exec("DELETE FROM subjects");
    $this->pdo->exec("DELETE FROM classes");
}
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function generate()
    {
        $names = [
            "Kovács Bence",
            "Szabó Anna",
            "Tóth Máté",
            "Nagy Dániel",
            "Varga Lili",
            "Horváth Zsófia",
            "Molnár Péter",
            "Balogh Gergő",
            "Farkas Réka",
            "Lakatos Dominik",
            "Takács Hanna",
            "Papp Ádám",
            "Kiss Luca",
            "Mészáros Márk",
            "Oláh Petra",
            "Simon Martin",
            "Rácz Eszter",
            "Fodor Tamás",
            "Szalai Bálint",
            "Bíró Viktória",
            "Gábor Levente",
            "Sipos Noémi"
        ];

        $subjects = ["matek", "tori", "biosz", "fizika", "magyar", "foldrajz"];

        foreach ($subjects as $s) {
            $stmt = $this->pdo->prepare("INSERT INTO subjects(name) VALUES(:name)");
            $stmt->execute(["name" => $s]);
        }
        


        $letters = ["A", "B", "C", "D", "E"];

        for ($year = 2022; $year <= 2024; $year++) {
            $classCount = rand(4, 5);

            for ($c = 0; $c < $classCount; $c++) {
                $grade = rand(9, 12);
                $letter = $letters[$c];

                $stmt = $this->pdo->prepare(
                    "INSERT INTO classes(grade,letter,year) VALUES(:g,:l,:y)"
                );

                $stmt->execute([
                    "g" => $grade,
                    "l" => $letter,
                    "y" => $year
                ]);

                $classId = $this->pdo->lastInsertId();

                $studentCount = rand(12, 15);

                for ($s = 0; $s < $studentCount; $s++) {
                    $name = $names[array_rand($names)];

                    $birthdate = rand(2005, 2010) . "-" . rand(1, 12) . "-" . rand(1, 28);

                    $stmt = $this->pdo->prepare("INSERT INTO students(name,birth_date,class_id)VALUES(:n,:b,:c)");

                    $stmt->execute([
                        "n" => $name,
                        "b" => $birthdate,
                        "c" => $classId
                    ]);

                    $studentId = $this->pdo->lastInsertId();
                    for ($m = 0; $m < rand(3, 4); $m++) {
                        $subjectId = rand(1, 6);
                        $mark = rand(1, 5);
                    
                        $date = date('Y-m-d', strtotime('-' . rand(0, 365) . ' days'));
                    
                        $stmt = $this->pdo->prepare(
                            "INSERT INTO marks(student_id,subject_id,mark,date)
                             VALUES(:s,:sub,:m,:d)"
                        );
                    
                        $stmt->execute([
                            "s" => $studentId,
                            "sub" => $subjectId,
                            "m" => $mark,
                            "d" => $date
                        ]);
                    }
                }
            }
        }
    }
}
