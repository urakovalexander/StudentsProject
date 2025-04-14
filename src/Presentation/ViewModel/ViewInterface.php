<?php

namespace App\Presentation\Shared\View;

/**
 * Interface for all ViewModels.
 */
interface ViewInterface
{
    /**
     * Convert the ViewModel to an array representation.
     *
     * @return array<int|string, mixed> Array representation of the ViewModel.
     */
    public function toArray(): array;
}
