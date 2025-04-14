<?php

namespace App\Application\UseCase;

use App\Application\Domain\Entity\StudentDto;
use App\Application\Exception\LoginAlreadyExistsException;
use App\Application\Repository\StudentRepositoryInterface;
use App\Infrastructure\Entity\Student;
use App\Infrastructure\Mapper\StudentMapper;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterStudent
{
    public function __construct(
        private StudentRepositoryInterface $studentRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function handle(string $login, string $name, string $password): StudentDto
    {
        $existing = $this->studentRepository->findOneByLogin($login);

        if ($existing !== null) {
            throw new LoginAlreadyExistsException($login);
        }

        $student = new Student();
        $student->setLogin($login);
        $student->setName($name);

        $hashedPassword = $this->passwordHasher->hashPassword($student, $password);
        $student->setPassword($hashedPassword);

        $this->studentRepository->save($student);

        return StudentMapper::toDto($student);
    }
}
