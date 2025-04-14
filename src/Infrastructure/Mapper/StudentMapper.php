<?php

namespace App\Infrastructure\Mapper;

use App\Infrastructure\Entity\Student;
use App\Application\Domain\Entity\StudentDto;

class StudentMapper
{
    public static function toDto(Student $student): StudentDto
    {
        return new StudentDto(
            id: $student->getId(),
            name: $student->getName(),
            login: $student->getLogin()
        );
    }
}
