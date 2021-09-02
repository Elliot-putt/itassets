<?php

namespace App\Observers;


use App\Models\Supplier;
use App\Models\Log;
use Carbon\Carbon;

class SupplierObserver
{
    public function created(supplier $supplier)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'supplier',
            'loggable_id'=> $supplier->id ?? 0,
            'data'=> auth()->user()->name.' created a new supplier - '.$supplier->name,
        ]);
    }

    public function updated(supplier $supplier)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'supplier',
            'loggable_id'=> $supplier->id ?? 0,
            'data'=> auth()->user()->name.' updated supplier - '.$supplier->name,
        ]);
    }

    public function deleted(supplier $supplier)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'supplier',
            'loggable_id'=> $supplier->id ?? 0,
            'data'=> auth()->user()->name.' deleted supplier - '.$supplier->name,
        ]);
    }

    public function restored(supplier $supplier)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'supplier',
            'loggable_id'=> $supplier->id ?? 0,
            'data'=> auth()->user()->name.' restored supplier - '.$supplier->name,
        ]);
    }

    public function forceDeleted(supplier $supplier)
    {
        Log::create([
            'user_id'=>auth()->user()->id ?? 0,
            'log_date'=> Carbon::now(),
            'loggable_type'=> 'supplier',
            'loggable_id'=> $supplier->id ?? 0,
            'data'=> auth()->user()->name.' permanently deleted supplier - '.$supplier->name,
        ]);
    }
}
