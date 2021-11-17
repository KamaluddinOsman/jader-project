<?php

namespace App\Observers;

use App\SpacialCategory;
use Illuminate\Http\Request;

class SpacialCategoryObserver
{
    /**
     * Handle the spacial category "created" event.
     *
     * @param  \App\SpacialCategory  $spacialCategory
     * @return void
     */
    public function created(SpacialCategory $spacialCategory)
    {
        //
    }

    /**
     * Handle the spacial category "updated" event.
     *
     * @param  \App\SpacialCategory  $spacialCategory
     * @return void
     */
    public function updated(SpacialCategory $spacialCategory)
    {
        $spacialCategory->products()->update(['status' => $spacialCategory->status] );
    }

    /**
     * Handle the spacial category "deleted" event.
     *
     * @param  \App\SpacialCategory  $spacialCategory
     * @return void
     */
    public function deleted(SpacialCategory $spacialCategory)
    {
        //
    }


    /**
     * Handle the spacial category "restored" event.
     *
     * @param  \App\SpacialCategory  $spacialCategory
     * @return void
     */
    public function restored(SpacialCategory $spacialCategory)
    {
        //
    }

    /**
     * Handle the spacial category "force deleted" event.
     *
     * @param  \App\SpacialCategory  $spacialCategory
     * @return void
     */
    public function forceDeleted(SpacialCategory $spacialCategory)
    {
        //
    }
}
