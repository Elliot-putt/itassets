<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

use App\Models\Asset;
use App\Models\Location;
use App\Models\User;

use Illuminate\Support\Facades\Cache;

class ExpenditureChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $locations = auth()->user()->locations;

        $years = [];
        $depreciation = [];
        foreach (range(\Carbon\Carbon::now()->year, \Carbon\Carbon::now()->year -7) as $year){
            $years[] = $year;
        }


              
        $chart = Chartisan::build()
            ->labels(array_reverse($years));

        foreach($locations as $location){
            $location_values = [];
            foreach(array_reverse($years) as $id => $y){
                if(!Cache::get('location-'.$location->id.'-'.$y)){
                    $total = Cache::rememberForever('location-'.$location->id.'-'.$y, function () use($location, $y){
                        return $location->expenditure($y);
                    });
                    $location_values[] = $location->expenditure($y);
                }
                $location_values[] = Cache::get('location-'.$location->id.'-'.$y);
            }
            $chart->advancedDataset($location->name, $location_values, ['borderColor'=> $location->icon, 'backgroundColor' => $location->icon]);
        }

        return $chart;
            
    }
}