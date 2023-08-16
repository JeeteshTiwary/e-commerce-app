<?php

namespace App\Observers;

use App\Models\Variation;

class VariationObserver
{
    /**
     * Handle the Variation "created" event.
     */
    public function created(Variation $variation): void
    {
        $user = auth()->id();
        if ($user) {
            $variation->created_by = $user;
            $variation->save();
        }
    }

    /**
     * Handle the Variation "updated" event.
     */
    public function updated(Variation $variation): void
    {
        $user = auth()->id();
        if ($user) {
            $variation->updated_by = $user;
            // $variation->save();
        }  
    }

    /**
     * Handle the Variation "deleted" event.
     */
    public function deleted(Variation $variation): void
    {
        //
    }

    /**
     * Handle the Variation "restored" event.
     */
    public function restored(Variation $variation): void
    {
        //
    }

    /**
     * Handle the Variation "force deleted" event.
     */
    public function forceDeleted(Variation $variation): void
    {
        //
    }
}
