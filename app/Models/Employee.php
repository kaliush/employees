<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;


class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position_id',
        'hire_date',
        'phone',
        'email',
        'salary',
        'photo',
        'admin_created_id',
        'admin_updated_id',
        'manager_id',
    ];

    public static function count(): int
    {
        return DB::table('employees')->count();
    }
    public function adminCreatedRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_created_id');
    }

    public function adminUpdatedRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_updated_id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id', 'id');
    }

    public function isManager(): bool
    {
        return $this->hasMany(Employee::class, 'manager_id')->exists();
    }

    public function hasManagerWithId()
    {
        return $this->manager_id !== null;
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(Employee::class, 'manager_id', 'id');
    }
}
