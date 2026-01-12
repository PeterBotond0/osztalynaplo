<?php

declare(strict_types=1);

class School
{
    private array $students = [];

    public function __construct(array $data)
    {
        foreach ($data['classes'] as $class) {
            $count = rand(10, 15);

            for ($i = 0; $i < $count; $i++) {
                $gender = rand(0, 1) ? 'fiu' : 'lany';

                $firstName = $gender === 'male'
                    ? $data['firstnames']['men'][array_rand($data['firstnames']['men'])]
                    : $data['firstnames']['women'][array_rand($data['firstnames']['women'])];

                $lastName = $data['lastnames'][array_rand($data['lastnames'])];

                $this->students[] = new Student(
                    $firstName,
                    $lastName,
                    $gender,
                    $class,
                    $data['subjects']
                );
            }
        }
    }

    public function getAllStudents(): array
    {
        return $this->students;
    }

    public function getStudentsByClass(string $class): array
    {
        return array_filter(
            $this->students,
            fn (Student $student) => $student->getClass() === $class
        );
    }
}
