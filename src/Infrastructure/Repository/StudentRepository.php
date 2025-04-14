<?php

namespace App\Infrastructure\Repository;

use App\Application\Repository\StudentRepositoryInterface;
use App\Infrastructure\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class StudentRepository implements StudentRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Student::class);
    }

    public function findOneByLogin(string $login): ?Student
    {
        return $this->repository->findOneBy(['login' => $login]);
    }

    public function save(Student $student): void
    {
        $this->entityManager->persist($student);
        $this->entityManager->flush();
    }

    public function findAllWithoutGroup(): array
    {
        return $this->repository->findBy(['groupId' => null]);
    }
}
