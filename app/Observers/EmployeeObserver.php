<?php

namespace App\Observers;

use App\Models\Employee;
use App\Services\ManagerService;
use Illuminate\Support\Facades\Auth;

class EmployeeObserver
{

    /**
     * Handle the Position "creating" event.
     */
    public function creating(Employee $employee): void
    {
        $employee->admin_created_id = Auth::id();
    }

    /**
     * Handle the Position "updating" event.
     */
    public function updating(Employee $employee): void
    {
        $employee->admin_updated_id = Auth::id();

    }

    /**
     * Handle the Employee "deleting" event.
     */
    public function deleting(Employee $employee): void
    {
        if ($employee->isManager()) {
            // Reassign the manager's subordinates to the next higher-level manager
            if ($employee->hasManagerWithId()) {
                $nextManager = $employee->manager;
                $employee->subordinates()->update(['manager_id' => $employee->manager_id]);
            } else {
                // Handle the case where the manager has no other manager
                $employee->subordinates()->update(['manager_id' => null]);
            }
        }
    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        //
    }
}
