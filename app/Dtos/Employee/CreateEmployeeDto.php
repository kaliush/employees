<?php

namespace App\Dtos\Employee;

readonly class CreateEmployeeDto
{
    public function __construct(
        public string  $name,
        public int     $position_id,
        public string  $hire_date,
        public string  $phone,
        public string  $email,
        public float   $salary,
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
            'photo' => $this->photo ?? null,
            'manager_id' => $this->manager_id ?? null,
        ];
    }

}

