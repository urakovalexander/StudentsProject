<?php

namespace App\Presentation\ViewModel;

final class StudentView implements ViewInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $login,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
        ];
    }
}
