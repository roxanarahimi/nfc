<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrokerResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\UserResource;
use App\Models\Broker;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;


class UserController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {
            $mobile = $request['mobile'];
            $user = User::where('mobile', $mobile)->first();
//            return $user;
//            $user = Broker::whereHas('State','2')->whereHas('Party', function ($q) use ($mobile) {
//                $q->where('Mobile',$mobile);
//            })->first();
//            if ($user && $user->role === 'admin') {
//                return response(['message' => 'این شماره موبایل قابل استفاده نیست. لطفا با شماره دیگری تلاش کنید.'], 422);
//            }
            $code = rand(1001, 9999);
            $text = 'کد تایید ورود به اپلیکیشن:' . $code;
            $sms = new Request([
                'mobile' => $mobile,
                'message' => $text,
            ]);

//            $send = $this->sendSms($sms);
            Cache::put($mobile, $code, 60);
            return $code;
            if ($send->getStatusCode() == 200) {
                return response(['message' => 'کد تایید ارسال شد.'], 200);

            } else {
                return $send;
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function sendSms(Request $request): Response
    {
        try {
            $api = new \Kavenegar\KavenegarApi("4470686233536566795848666962306F59327335574D786772655075704668586C31415162524E717747413D");
            $sender = "10005989";
            $message = $request['message'];
            $receptor = array($request['mobile']);
            $result = $api->Send($sender, $receptor, $message);
            if ($result) {
                $info = [
                    "messageid" => $result[0]->messageid,
                    "message" => $result[0]->message,
                    "status" => $result[0]->status,
                    "statustext" => $result[0]->statustext,
                    "sender" => $result[0]->sender,
                    "receptor" => $result[0]->receptor,
                    "date" => $result[0]->date,
                    "cost" => $result[0]->cost
                ];

            } else {
                $info = $result;
            }
            return response($info, 200);

        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            return $e;
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            return $e;
        }
    }

    public function verifyMobile(Request $request)
    {
        try {
            $mobile = $request['mobile'];
            $inputCode = $request['code'];
            $code = Cache::get($mobile);

//            return [$code ,$inputCode] ;
            if ($code == $inputCode) {
                $user = User::where('mobile', $mobile)->first();
                if (!$user) {
                    return response(['message' => 'این کاربر وجود ندارد'], 422);
                }
                return response(['user' => $user, 'message' => 'شما با موفقیت وارد شدید.'], 200);
            } else {
                return response(['message' => 'کد وارد شده اشتباه است.'], 422);
            }
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function brokers()
    {
        try {
            $dat2 = Broker::where('State','2')->orderByDesc('BrokerID')->take(100)->get();
            return response( BrokerResource::collection($dat2), 200);
        } catch (\Exception $exception) {
            return $exception;
        }


    }
    public function broker($id)
    {
        try {
            $dat2 = Broker::where('State', 2)->where('BrokerID',$id)->first();
            return response( new BrokerResource($dat2), 200);
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
    public function customer($id)
    {
        try {
            $dat2 = Broker::where('CustomerID', $id)->first();
            return response( new BrokerResource($dat2), 200);
        } catch (\Exception $exception) {
            return $exception;
        }


    }
}
