<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrokerResource;
use App\Http\Resources\CustomerResource;
use App\Models\Address;
use App\Models\Broker;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Scan;
use Illuminate\Http\Request;

class ScanController extends Controller
{

    public function index()
    {
        try {
            $scans = Scan::all();
            return response($scans, 200);
        } catch (\Exception $exception) {
            return $exception;
        }
    }


    public function store(Request $request)
    {
        try {
            $scan = Scan::create($request->all());
            return response($scan, 201);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function show(Scan $scan)
    {
        try {
            $scan = Scan::findOrFail($scan);
            return response($scan, 200);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function update(Request $request, Scan $scan)
    {
        try {
            $scan = Scan::find($scan);
            $scan->update($request->all());
            return response($scan, 200);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function destroy(Scan $scan)
    {
        try {
            $scan = Scan::find($scan);
            $scan->delete();
            return response('scan deleted successfully', 200);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function test()
    {


        try {
//            $dat = Customer::with('Party')->with('CustomerAddress', function ($q) {
//              return $q->with('Address');
//            })->orderByDesc('CustomerID')->first();
            $dat2 = Broker::with('Party')->orderByDesc('BrokerID')->take(100)->get();

            return response(new $dat2, 200);
            return response(new BrokerResource($dat2), 200);
        } catch (\Exception $exception) {
            return $exception;
        }


//        $dat2 = DB::connection('sqlsrv')->table('LGS3.InventoryVoucher')->
//        select([
//            "SLS3.Broker.InventoryVoucherID as OrderID", "LGS3.InventoryVoucher.Number as OrderNumber",
//            "GNR3.Address.Name as AddressName", "GNR3.Address.Details as Address", "Phone",
//            "LGS3.InventoryVoucher.CreationDate", "Date as DeliveryDate", "CounterpartEntityText", "CounterpartEntityRef"])
//            ->join('GNR3.Party', 'GNR3.Party.PartyID', '=', 'LGS3.InventoryVoucher.CounterpartEntityRef')
//            ->join('GNR3.PartyAddress', 'GNR3.PartyAddress.PartyRef', '=', 'GNR3.Party.PartyID')
//            ->join('GNR3.Address', 'GNR3.Address.AddressID', '=', 'GNR3.PartyAddress.AddressRef')
//            ->where('LGS3.InventoryVoucher.FiscalYearRef', 1405)
//            ->where('LGS3.InventoryVoucher.Date', '>=', today()->subDays(7))
//            ->where('LGS3.InventoryVoucher.InventoryVoucherSpecificationRef', 69)
//            ->where('GNR3.PartyAddress.IsMainAddress', "1")
//            ->orderByDesc('LGS3.InventoryVoucher.InventoryVoucherID')
//            ->get()->toArray();
    }
}
