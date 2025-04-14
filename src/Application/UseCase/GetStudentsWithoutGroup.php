<?php

namespace App\Application\UseCase;

use App\Application\Domain\Entity\StudentDto;
use App\Application\Repository\StudentRepositoryInterface;
use App\Infrastructure\Mapper\StudentMapper;

class GetStudentsWithoutGroup
{
    public function __construct(private StudentRepositoryInterface $repository)
    {
    }

    /**
     * @return StudentDto[]
     */
    public function handle(): array
    {
        $students = $this->repository->findAllWithoutGroup();

        return array_map(
            fn($student) => StudentMapper::toDto($student),
            $students
        );
    }
}
