<?php

namespace App\Observers;

use App\Models\category;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     */
    public function created(category $category): void
    {
        $category->created_by = auth()->id();
        $category->save();
    }

    /**
     * Handle the category "updated" event.
     */
    public function updated(category $category): void
    {
        $category->updated_by = auth()->id();
        // dd($category->updated_by);
        // $category->save();
    }

    /**
     * Handle the category "deleted" event.
     */
    public function deleted(category $category): void
    {
        //
    }

    /**
     * Handle the category "restored" event.
     */
    public function restored(category $category): void
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     */
    public function forceDeleted(category $category): void
    {
        //
    }
}
