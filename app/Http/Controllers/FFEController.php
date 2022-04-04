<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\FFE;
use App\Models\Manufacturer;
use App\Models\Supplier;
use App\Models\Status;
use App\Models\Category;
use App\Models\Report;

use Illuminate\Support\Facades\Validator;

use App\Rules\permittedLocation;
use App\Rules\findLocation;

//Imports
use App\Imports\FFEImport;

//Exprots
use App\Exports\FFEErrorsExport;
use App\Exports\FFEExport;

//Jobs
use App\Jobs\FFESPdf;

class FFEController extends Controller {

    //FFE = Furniture, Fixtures and Equipment

    ////////////////////////////////////////////
    ////////////// View Functions ////////////
    ////////////////////////////////////////////

    public function index()
    {
        //Check to see if the User has permission to View All the AUC.
        if(auth()->user()->cant('viewAll', FFE::class))
        {
            return to_route('errors.forbidden', ['area', 'FFE', 'view']);
        }

        //Find the locations that the user has been assigned to
        $locations = Location::whereIn('id', auth()->user()->locations->pluck('id'))->select('id', 'name')->withCount('ffe')->get();

        //Find the properties that are assigned to the locations the User has permissions to.
        $limit = session('ffe_limit') ?? 25;
        $ffes = FFE::locationFilter($locations->pluck('id')->toArray())->paginate(intval($limit))->fragment('table');

        //No filter is set so set the Filter Session to False - this is to display the filter if is set
        session(['ffe_filter' => false]);

        return view('FFE.view', [
            "ffes" => $ffes,
            "locations" => $locations,
        ]);
    }

    public function show(FFE $ffe)
    {
        return view('FFE.show', compact('ffe'));
    }

    public function recycleBin()
    {
        if(auth()->user()->cant('viewAll', FFE::class))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised | View FFE Recycle Bin.');

        }
        $ffes = auth()->user()->location_ffes()->onlyTrashed()->get();

        return view('FFE.bin', compact('ffes'));
    }

    ////////////////////////////////////////////
    ////////////// Create Functions ////////////
    ////////////////////////////////////////////

    public function create()
    {

        //Check to see if the User is has permission to create an AUC
        if(auth()->user()->cant('create', FFE::class))
        {
            return to_route('errors.forbidden', ['area', 'FFE', 'create']);
        }

        //Find the locations that the user has been assigned to
        $locations = Location::whereIn('id', auth()->user()->locations->pluck('id'))->select('id', 'name')->withCount('ffe')->get();

        $manufacturers = Manufacturer::all();
        $suppliers = Supplier::all();
        $statuses = Status::all();
        // Return the Create View to the browser
        return view('FFE.create', [
            "locations" => $locations,
            "manufacturers" => $manufacturers,
            "suppliers" => $suppliers,
            "statuses" => $statuses,
        ]);
    }

    public function store(Request $request)
    {
        if(auth()->user()->cant('create', FFE::class))
        {
            return ErrorController::forbidden(to_route('ffes.index'), 'Unauthorised to Create Furniture, Fixtures and Equipment.');

        }

        $request->validate([
            "name" => "required|max:255",
            "supplier_id" => "nullable",
            "location_id" => "required",
            "room" => "nullable",
            "notes" => "nullable",
            "status_id" => "nullable",
            'order_no' => 'nullable',
            'serial_no' => 'required',
            'warranty' => 'int|nullable',
            'purchased_date' => 'nullable|date',
            'purchased_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);


        $ffe = FFE::create(array_merge($request->only(
            'name', 'serial_no', 'status_id', 'purchased_date', 'purchased_cost', 'donated', 'supplier_id', 'order_no', 'warranty', 'location_id', 'room', 'manufacturer_id', 'notes', 'photo_id', 'depreciation_id'
        ), ['user_id' => auth()->user()->id]));

        if($request->category != '' && !empty(explode(',', $request->category))){
            $ffe->category()->attach(explode(',', $request->category));
        }

        return to_route("ffes.index")->with('success_message', $request->name . 'has been successfully created!');
    }

    ////////////////////////////////////////////
    ////////////// Update Functions ////////////
    ////////////////////////////////////////////

    public function edit(FFE $ffe)
    {
        //Check to see if the User is has permission to create an AUC
        if(auth()->user()->cant('update', $ffe))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised | Update FFE.');
        }

        //Find the locations that the user has been assigned to
        $locations = Location::whereIn('id', auth()->user()->locations->pluck('id'))->select('id', 'name')->withCount('ffe')->get();

        $manufacturers = Manufacturer::all();
        $suppliers = Supplier::all();
        $statuses = Status::all();
        // Return the Create View to the browser
        return view('FFE.edit', [
            "ffe" => $ffe,
            "locations" => $locations,
            "manufacturers" => $manufacturers,
            "suppliers" => $suppliers,
            "statuses" => $statuses,
        ]);
    }

    public function update(Request $request, FFE $ffe)
    {
        if(auth()->user()->cant('update', $ffe))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised | Update FFE.');
        }

        $request->validate([
            "name" => "required|max:255",
            "supplier_id" => "nullable",
            "location_id" => "required",
            "room" => "nullable",
            "notes" => "nullable",
            "status_id" => "nullable",
            'order_no' => 'nullable',
            'serial_no' => 'required',
            'warranty' => 'int|nullable',
            'purchased_date' => 'nullable|date',
            'purchased_cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if(isset($request->donated) && $request->donated == 1)
        {
            $donated = 1;
        } else
        {
            $donated = 0;
        }

        $ffe->fill(array_merge($request->only(
            'name', 'serial_no', 'status_id', 'purchased_date', 'purchased_cost', 'supplier_id', 'order_no', 'warranty', 'location_id', 'room', 'manufacturer_id', 'notes', 'photo_id', 'depreciation_id'
        ), ['donated' => $donated]))->save();
        session()->flash('success_message', $ffe->name . ' has been Updated successfully');
        if($request->category != '' && !empty(explode(',', $request->category)))
        {
            $ffe->category()->sync(explode(',', $request->category));
        }

        return to_route("ffes.index");
    }

    ////////////////////////////////////////////
    ////////////// Delete Functions ////////////
    ////////////////////////////////////////////

    public function destroy(FFE $ffe)
    {
        if(auth()->user()->cant('delete', $ffe))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised | Delete FFE.');

        }

        $name = $ffe->name;
        $ffe->delete();
        session()->flash('danger_message', $name . ' was sent to the Recycle Bin');

        return to_route('ffes.index');
    }

    public function restore($id)
    {
        $accessory = Accessory::withTrashed()->where('id', $id)->first();
        if(auth()->user()->cant('delete', $accessory))
        {
            return ErrorController::forbidden(to_route('accessories.index'), 'Unauthorised to Restore Accessory.');
        }
        $accessory->restore();
        session()->flash('success_message', "#" . $accessory->name . ' has been restored.');

        return to_route("accessories.index");
    }

    public function forceDelete($id)
    {
        $accessory = Accessory::withTrashed()->where('id', $id)->first();
        if(auth()->user()->cant('forceDelete', $accessory))
        {
            return ErrorController::forbidden(to_route('accessories.index'), 'Unauthorised to Delete Accessory.');

        }
        $name = $accessory->name;
        $accessory->forceDelete();
        session()->flash('danger_message', "Accessory - " . $name . ' was deleted permanently');

        return to_route('accessories.bin');
    }

    ///////////////////////////////////////////
    ///////////// Import Functions ////////////
    ///////////////////////////////////////////

    public function import(Request $request)
    {
        if(auth()->user()->cant('create', FFE::class))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised | Import FFE.');

        }
        $extensions = array("csv");

        $result = array($request->file('csv')->getClientOriginalExtension());

        if(in_array($result[0], $extensions))
        {
            $path = $request->file("csv")->getRealPath();
            $import = new FFEImport;
            $import->import($path, null, \Maatwebsite\Excel\Excel::CSV);
            $row = [];
            $attributes = [];
            $errors = [];
            $values = [];
            $results = $import->failures();
            $importErrors = [];
            foreach($results->all() as $result)
            {
                $row[] = $result->row();
                $attributes[] = $result->attribute();
                $errors[] = $result->errors();
                $values[] = $result->values();
                $importErrors[] = [

                    "row" => $result->row(),
                    "attributes" => $result->attribute(),
                    "errors" => $result->errors(),
                    "value" => $result->values(),
                ];

            }

            if(! empty($importErrors))
            {
                $errorArray = [];
                $valueArray = [];
                $errorValues = [];

                foreach($importErrors as $error)
                {
                    if(array_key_exists($error['row'], $errorArray))
                    {
                        $errorArray[$error['row']] = $errorArray[$error['row']] . ',' . $error['attributes'];
                    } else
                    {
                        $errorArray[$error['row']] = $error['attributes'];
                    }
                    $valueArray[$error['row']] = $error['value'];

                    if(array_key_exists($error['row'], $errorValues))
                    {
                        $array = $errorValues[$error['row']];
                    } else
                    {
                        $array = [];
                    }

                    foreach($error['errors'] as $e)
                    {
                        $array[$error['attributes']] = $e;
                    }
                    $errorValues[$error['row']] = $array;

                }

                return view('FFE.importErrors', [
                    "errorArray" => $errorArray,
                    "valueArray" => $valueArray,
                    "errorValues" => $errorValues,
                    "locations" => auth()->user()->locations,
                    "statuses" => Status::all(),
                    "suppliers" => Supplier::all(),
                    "locations" => auth()->user()->locations,
                    "manufacturers" => Manufacturer::all()
                ]);

            } else
            {
                return to_route('ffes.index')->with('success_message', 'All FFE were imported correctly!');

            }
        } else
        {
            session()->flash('danger_message', 'Sorry! This File type is not allowed Please try a ".CSV!"');

            return to_route('ffes.index');
        }


    }

    public function importErrors(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name.*" => "required|max:255",
            'location_id.*' => 'required|gt:0',
            'purchased_date.*' => 'date',
            'purchased_cost.*' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            "depreciation.*" => "nullable",
            "type.*" => "nullable",
        ]);

        if($validation->fails())
        {
            return $validation->errors();
        } else
        {
            for($i = 0; $i < count($request->name); $i++)
            {
                $ffe = new FFE;

                $location = Location::find($request->location_id[$i]);
                $ffe->name = $request->name[$i];
                //Serial No Cannot be ""
                //If the imported Serial Number is empty assign it to "0"
                $request->serial_no[$i] != '' ? $ffe->serial_no = $request->serial_no[$i] : $ffe->serial_no = "-";
                $ffe->status_id = $request->status_id[$i];
                $ffe->purchased_date = \Carbon\Carbon::parse(str_replace('/', '-', $request->purchased_date[$i]))->format("Y-m-d");
                $ffe->purchased_cost = $request->purchased_cost[$i];
                $ffe->donated = $request->donated[$i];
                $ffe->supplier_id = $request->supplier_id[$i];
                $ffe->manufacturer_id = $request->manufacturer_id[$i];
                $ffe->order_no = $request->order_no[$i];
                $ffe->warranty = $request->warranty[$i];
                $ffe->location_id = $request->location_id[$i];
                $ffe->room = $request->room[$i] ?? 'N/A';
                $ffe->notes = $request->notes[$i];
                $ffe->photo_id = 0;
                $ffe->depreciation_id = $request->depreciation_id[$i];
                $ffe->user_id = auth()->user()->id;
                $ffe->save();
            }

            session()->flash('success_message', 'You have successfully added all Furniture, Fixtures and Equipment!');

            return 'Success';
        }
    }

    public function exportImportErrors(Request $request)
    {
        $export = $request['name'];
        $code = (htmlspecialchars_decode($export));
        $export = json_decode($code);

        if(auth()->user()->cant('viewAll', FFE::class))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised to Export FFE Errors.');

        }

        $date = \Carbon\Carbon::now()->format('dmyHis');
        \Maatwebsite\Excel\Facades\Excel::store(new FFEErrorsExport($export), "/public/csv/ffe-errors-{$date}.csv");
        $url = asset("storage/csv/ffe-errors-{$date}.csv");

        return to_route('ffes.index')
            ->with('success_message', "Your Export has been created successfully. Click Here to <a href='{$url}'>Download CSV</a>")
            ->withInput();
    }

    ///////////////////////////////////////////
    ///////////// Export Functions ////////////
    ///////////////////////////////////////////

    public function export(Request $request)
    {
        if(auth()->user()->cant('viewAll', FFE::class))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised | Export FFE Information.');

        }
        $aucs = FFE::withTrashed()->whereIn('id', json_decode($request->ffes))->with('location')->get();
        $date = \Carbon\Carbon::now()->format('dmyHi');
        \Maatwebsite\Excel\Facades\Excel::store(new FFEExport($aucs), "/public/csv/ffes-{$date}.xlsx");
        $url = asset("storage/csv/ffes-{$date}.xlsx");

        return to_route('ffes.index')
            ->with('success_message', "Your Export has been created successfully. Click Here to <a href='{$url}'>Download CSV</a>")
            ->withInput();

    }

     ////////////////////////////////////////////////////////
    ///////////////PDF Functions////////////////////////////
    ////////////////////////////////////////////////////////


    public function downloadPDF(Request $request)
    {
        if(auth()->user()->cant('viewAll', FFE::class))
        {
            return ErrorController::forbidden(route('ffes.index'), 'Unauthorised | Download of FFE Report.');

        }
        $aucs = array();
        $found = FFE::withTrashed()->whereIn('id', json_decode($request->ffes))->with('location')->get();
        foreach($found as $f)
        {
            $array = array();
            $array['name'] = $f->name;
            $array['serial_no'] = $f->serial_no ?? 'N/A';
            $array['location'] = $f->location->name ?? 'Unallocated';
            $array['room'] = $f->room ?? 'N/A';
            $array['icon'] = $f->location->icon ?? '#666';
            $array['manufacturer'] = $f->manufacturer->name ?? 'N/A';
            $array['purchased_date'] = \Carbon\Carbon::parse($f->purchased_date)->format('d/m/Y');
            $array['purchased_cost'] = '£' . $f->purchased_cost;
            $array['donated'] = '£' . $f->donated;
            if($f->depreciation_id != 0){
                $eol = \Carbon\Carbon::parse($f->purchased_date)->addYears($f->depreciation_id);
                $age = \Carbon\Carbon::now()->floatDiffInYears($f->purchased_date);
                $percent = 100 / $f->depreciation->years;
                $percentage = floor($age) * $percent;
                $dep = $f->purchased_cost * ((100 - $percentage) / 100);
            }else{
                $dep = $f->purchased_cost;
            } 
            $array['depreciation'] = $dep;
            $array['supplier'] = $f->supplier->name ?? 'N/A';
            $array['warranty'] = $f->warranty;
            $array['status'] = $f->status->name ?? 'Unknown';
            $array['color'] = $f->status->colour ?? '#666';
            $ffes[] = $array;
        }

        $user = auth()->user();

        $date = \Carbon\Carbon::now()->format('dmyHis');
        $path = 'ffes-report-' . $date;

        FFESPdf::dispatch($ffes, $user, $path)->afterResponse();

        $url = "storage/reports/{$path}.pdf";
        $report = Report::create(['report' => $url, 'user_id' => $user->id]);

        return to_route('ffes.index')
            ->with('success_message', "Your Report is being processed, check your reports here - <a href='/reports/' title='View Report'>Generated Reports</a> ")
            ->withInput();

    }

    public function downloadShowPDF(AUC $auc)
    {
        if(auth()->user()->cant('generateShowPDF', $auc))
        {
            return ErrorController::forbidden(to_route('aucs.index'), 'Unauthorised | Download of Property Information.');

        }

        $user = auth()->user();

        $date = \Carbon\Carbon::now()->format('dmyHis');
        $path = "aucs-{$auc->id}-{$date}";
        AUCPdf::dispatch($auc, $user, $path)->afterResponse();
        $url = "storage/reports/{$path}.pdf";
        $report = Report::create(['report' => $url, 'user_id' => $user->id]);

        return to_route('aucs.show', $auc->id)
            ->with('success_message', "Your Report is being processed, check your reports here - <a href='/reports/' title='View Report'>Generated Reports</a> ")
            ->withInput();
    }
}
