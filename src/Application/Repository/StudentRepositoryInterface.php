<?php

namespace App\Application\Repository;

use App\Infrastructure\Entity\Student;

interface StudentRepositoryInterface
{
    public function findOneByLogin(string $login): ?Student;

    public function save(Student $student): void;
}
