<?php

namespace App\Dtos\Employee;

readonly class UpdateEmployeeDto
{
    public function __construct(
        public ?string $name = null,
        public ?int    $position_id = null,
        public ?string $hire_date = null,
        public ?string $phone = null,
        public ?string $email = null,
        public ?float  $salary = null,
        public ?string $photo = null,
        public ?int    $manager_id = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'position_id' => $this->position_id,
            'hire_date' => $this->hire_date,
            'phone' => $this->phone,
            'email' => $this->email,
            'salary' => $this->salary,
            'photo' => $this->photo,
            'manager_id' => $this->manager_id,
        ];
    }
}
