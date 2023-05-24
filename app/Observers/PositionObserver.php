<?php

namespace App\Observers;

use App\Models\Position;
use Illuminate\Support\Facades\Auth;

class PositionObserver
{
    /**
     * Handle the Position "created" event.
     */
    public function creating(Position $position): void
    {
        $position->admin_created_id = Auth::id();
    }

    /**
     * Handle the Position "updated" event.
     */
    public function updating(Position $position): void
    {
        $position->admin_updated_id = Auth::id();
    }

    /**
     * Handle the Position "deleted" event.
     */
    public function deleted(Position $position): void
    {
        //
    }

    /**
     * Handle the Position "restored" event.
     */
    public function restored(Position $position): void
    {
        //
    }

    /**
     * Handle the Position "force deleted" event.
     */
    public function forceDeleted(Position $position): void
    {
        //
    }
}
