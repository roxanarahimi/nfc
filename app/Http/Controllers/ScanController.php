<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use Illuminate\Http\Request;

class ScanController extends Controller
{

    public function index()
    {
        try {
            $scans = Scan::all();
            return response($scans,200);
        }catch (\Exception $exception){
            return $exception;
        }
    }


    public function store(Request $request)
    {
        try {
            $scan = Scan::create($request->all());
            return response($scan,201);
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function show(Scan $scan)
    {
        try {
            $scan = Scan::findOrFail($scan);
            return response($scan,200);
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function update(Request $request, Scan $scan)
    {
        try {
            $scan = Scan::find($scan);
            $scan->update($request->all());
            return response($scan,200);
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function destroy(Scan $scan)
    {
        try {
            $scan = Scan::find($scan);
            $scan->delete();
            return response('scan deleted successfully',200);
        }catch (\Exception $exception){
            return $exception;
        }
    }
}
