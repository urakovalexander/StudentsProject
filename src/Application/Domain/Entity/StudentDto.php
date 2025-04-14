<?php

namespace App\Application\Domain\Entity;

class StudentDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $login,
    ) {}
}
