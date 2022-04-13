<?php

namespace App\Observers;

use App\Jobs\ColumnLogger;
use App\Models\Component;
use App\Models\Log;
use Carbon\Carbon;

class ComponentObserver {

    public function __construct()
    {
        $this->user = $this->user . 'An Unauthorized User';
    }

    public function created(Component $component)
    {
        Log::create([
            'user_id' => auth()->user()->id ?? 0,
            'log_date' => Carbon::now(),
            'loggable_type' => 'component',
            'loggable_id' => $component->id ?? 0,
            'data' => $this->user . "Unknown" . " created a new Component - {$component->name}",
        ]);
    }

    public function updated(Component $component)
    {
        /////////////////////////////////////////////
        /////////// Dynamic Column changes///////////
        /////////////////////////////////////////////
        // Ignored these Table names
        $exceptions = ['id', 'created_at', 'updated_at'];
        ColumnLogger::dispatchSync($exceptions, $component);
        /////////////////////////////////////////////
        //////// Dynamic Column changes End//////////
        /////////////////////////////////////////////
    }

    public function deleted(Component $component)
    {
        Log::create([
            'user_id' => auth()->user()->id ?? 0,
            'log_date' => Carbon::now(),
            'loggable_type' => 'component',
            'loggable_id' => $component->id ?? 0,
            'data' => $this->user . "Unknown" . " sent Component - {$component->name} to the Recycle Bin",
        ]);
    }

    public function restored(Component $component)
    {
        Log::create([
            'user_id' => auth()->user()->id ?? 0,
            'log_date' => Carbon::now(),
            'loggable_type' => 'component',
            'loggable_id' => $component->id ?? 0,
            'data' => $this->user . "Unknown" . " restored Component - {$component->name}",
        ]);
    }

    public function forceDeleted(Component $component)
    {
        Log::create([
            'user_id' => auth()->user()->id ?? 0,
            'log_date' => Carbon::now(),
            'loggable_type' => 'component',
            'loggable_id' => $component->id ?? 0,
            'data' => $this->user . "Unknown" . " has permanently deleted Component - {$component->name}",
        ]);
    }

}
