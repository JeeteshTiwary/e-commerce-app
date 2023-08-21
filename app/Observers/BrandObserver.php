<?php

namespace App\Observers;

use App\Models\Brand;

class BrandObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;
    /**
     * Handle the Brand "created" event.
     */
    public function created(Brand $brand): void
    {
        $user = auth()->id();
        if ($user) {
            $brand->created_by = $user;
            $brand->save();
        }
    }

    /**
     * Handle the Brand "updated" event.
     */
    public function updated(Brand $brand): void
    {
        $user = auth()->id();
        if ($user) {
            $brand->updated_by = $user;
            // $brand->save();
        }     
    }

    /**
     * Handle the Brand "deleted" event.
     */
    public function deleted(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "restored" event.
     */
    public function restored(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     */
    public function forceDeleted(Brand $brand): void
    {
        //
    }
}