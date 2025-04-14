<?php
namespace App\Presentation\ViewModel;

use App\Infrastructure\Entity\Student;

class StudentView
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}

    public static function fromEntity(Student $student): self
    {
        return new self(
            id: $student->getId(),
            name: $student->getName()
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
