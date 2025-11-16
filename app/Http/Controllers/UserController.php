<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrokerResource;
use App\Http\Resources\CustomerResource;
use App\Models\Broker;
use App\Models\Customer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function brokers()
    {
        try {
            $dat2 = Broker::with('Party')->orderByDesc('BrokerID')->take(100)->get();
            return response( BrokerResource::collection($dat2), 200);
        } catch (\Exception $exception) {
            return $exception;
        }


    }
    public function customers()
    {
        try {
            $dat = Customer::with('Party')->with('CustomerAddress', function ($q) {
              return $q->with('Address');
            })->orderByDesc('CustomerID')->first();
            return response( CustomerResource::collection($dat), 200);
        } catch (\Exception $exception) {
            return $exception;
        }


    }
}
