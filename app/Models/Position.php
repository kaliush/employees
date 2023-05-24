<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function count(): int
    {
        return DB::table('employees')->count();
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
