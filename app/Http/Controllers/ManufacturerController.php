<?php

namespace App\Http\Controllers;

use App\Exports\ManufacturerExport;
use App\Imports\ManufacturerImport;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Location;

class ManufacturerController extends Controller {

    public function index()
    {
        return view('Manufacturers.view', [
            "manufacturers" => Manufacturer::all(),
        ]);

    }

    public function create()
    {
        return view("Manufacturers.create", [
            "manufacturerAmount" => count(Manufacturer::all()),
        ]);

    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('Manufacturers.edit', [
            "manufacturer" => $manufacturer,
        ]);

    }

    public function update(Manufacturer $manufacturers)
    {
        request()->validate([
            "name" => "required|max:255",
            "supportPhone" => "required|max:14",
            "supportUrl" => "required",
            'supportEmail' => ['required', \Illuminate\Validation\Rule::unique('manufacturers')->ignore($manufacturers->id)],
            "PhotoId" => "nullable",
        ]);
        $manufacturers->fill([
            "name" => request("name"),
            "supportPhone" => request("supportPhone"),
            "supportUrl" => request("supportUrl"),
            "supportEmail" => request("supportEmail"),
            "photoId" => request("photoId")])->save();

        session()->flash('success_message', request("name") . ' has been updated successfully');

        return redirect('/manufacturers');
    }

    public function store()
    {
        request()->validate([
            "name" => "required|unique:manufacturers,name|max:255",
            "supportPhone" => "required|max:14",
            "supportUrl" => "required",
            "supportEmail" => 'required|unique:manufacturers,supportEmail|email:rfc,dns,spoof,filter',
            "PhotoId" => "nullable",
        ]);
        Manufacturer::create([
            "name" => request("name"),
            "supportPhone" => request("supportPhone"),
            "supportUrl" => request("supportUrl"),
            "supportEmail" => request("supportEmail"),
            "photoId" => request("photoId"),
            session()->flash('success_message', request("name") . ' has been created successfully'),
        ]);

        return redirect('/manufacturers');
    }

    public function ajaxMany(Request $request)
    {
        if($request->ajax())
        {
            $validation = Validator::make($request->all(), [
                "name.*" => "required|unique:manufacturers,name|max:255",
                "supportPhone.*" => "required|max:14",
                "supportUrl.*" => "required",
                "supportEmail.*" => 'required|unique:manufacturers,supportEmail|email:rfc,dns,spoof,filter',
            ]);

            if($validation->fails())
            {
                return $validation->errors();
            } else
            {
                for($i = 0; $i < count($request->name); $i++)
                {
                    Manufacturer::Create([
                        "name" => $request->name[$i],
                        "supportPhone" => $request->supportPhone[$i],
                        "supportUrl" => $request->supportUrl[$i],
                        "supportEmail" => $request->supportEmail[$i],

                    ]);
                }
                session()->flash('success_message', 'You can successfully added the Manufacturers');

                return 'Success';
            }
        }

    }

    public function destroy(Manufacturer $manufacturer)
    {
        $name = $manufacturer->name;
        $manufacturer->delete();
        session()->flash('danger_message', $name . ' was deleted from the system');

        return redirect(route("manufacturers.index"));
    }

    public function export(Manufacturer $manufacturer)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new ManufacturerExport, 'manufacturer.csv');
    }

    public function import(Request $request)
    {
        $extensions = array("csv");

        $result = array($request->file('csv')->getClientOriginalExtension());

        if(in_array($result[0], $extensions))
        {
            $path = $request->file("csv")->getRealPath();
            $import = new ManufacturerImport;
            $import->import($path, null, \Maatwebsite\Excel\Excel::CSV);
            $errors = $import->failures();
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

                return view('Manufacturers.import-errors', [
                    "errorArray" => $errorArray,
                    "valueArray" => $valueArray,
                    "errorValues" => $errorValues,
                ]);

            } else
            {
                return redirect('/manufacturers')->with('success_message', 'All Manufacturers were added correctly!');
            }
        } else
        {
            session()->flash('danger_message', 'Sorry! This File type is not allowed Please try a ".CSV"!');

            return redirect('/manufacturers');
        }

    }

}
