<?php

namespace App\Dtos\Position;

class UpdatePositionDto
{
    public function __construct(
        public ?string $name = null)
    {
    }

}
