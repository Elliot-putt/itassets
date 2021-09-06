<?php

namespace App\Observers;

use App\Models\Accessory;
use App\Models\Log;
use Carbon\Carbon;

class AccessoryObserver
{

    public function created(Accessory $accessory)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'accessory',
            'loggable_id'=> $accessory->id ?? 0,
            'data'=> auth()->user()->name ?? "Unknown"." created a new Accessory - {$accessory->name}"
        ]);
    }

    public function updated(Accessory $accessory)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'accessory',
            'loggable_id'=> $accessory->id ?? 0,
            'data'=> auth()->user()->name ?? "Unknown"." updated Accessory - {$accessory->name}"
        ]);
    }

    public function deleted(Accessory $accessory)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'accessory',
            'loggable_id'=> $accessory->id ?? 0,
            'data'=> auth()->user()->name ?? "Unknown"." deleted Accessory - {$accessory->name}"
        ]);
    }

    public function restored(Accessory $accessory)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'accessory',
            'loggable_id'=> $accessory->id ?? 0,
            'data'=> auth()->user()->name ?? "Unknown"." restored Accessory - {$accessory->name}"
        ]);
    }

    public function forceDeleted(Accessory $accessory)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'accessory',
            'loggable_id'=> $accessory->id ?? 0,
            'data'=> auth()->user()->name ?? "Unknown"." permanently deleted Accessory - {$accessory->name}"
        ]);
    }
}
