<?php

namespace App\Application\UseCase;

use App\Application\Repository\StudentRepositoryInterface;
use App\Infrastructure\Entity\Student;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterStudent
{
    public function __construct(
        private StudentRepositoryInterface $studentRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function handle(string $login, string $name, string $password): Student
    {
        $existing = $studentRepository->findOneByLogin($login);

        if ($existing !== null) {
            throw new \InvalidArgumentException("Login '$login' is already in use.");
        }

        $student = new Student();
        $student->setLogin($login);
        $student->setName($name);

        $hashedPassword = $this->passwordHasher->hashPassword($student, $password);
        $student->setPassword($hashedPassword);

        $this->studentRepository->save($student);

        return $student;
    }
}
