<?php

declare(strict_types=1);

class Student
{
    private string $firstName;
    private string $lastName;
    private string $gender;
    private string $class;
    private array $grades = [];

    public function __construct(
        string $firstName,
        string $lastName,
        string $gender,
        string $class,
        array $subjects
    ) {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->gender    = $gender;
        $this->class     = $class;

        foreach ($subjects as $subject) {
            $count = rand(0, 5);
            $this->grades[$subject] = [];

            for ($i = 0; $i < $count; $i++) {
                $this->grades[$subject][] = rand(1, 5);
            }
        }
    }

    public function getName(): string
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getGrades(): array
    {
        return $this->grades;
    }
}
