<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class TestController extends Controller
{
    public function test()
    {
        $randomString = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
        $data = (object)[
            'ChoosePayment' => 'ALL',
            'ClientBackURL' => route('back'),
            'EncryptType' => 1,
            'ItemName' => '美琪花卉',
            'IgnorePayment' => 'WebATM#CVS#BARCODE', //關掉不要的付款方式
            'MerchantID' => '3002607', // 後面預設值為測試API的參數
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'MerchantTradeNo' => 'GW202309020006FPE' . $randomString,
            'PaymentInfoURL' => 'https://demo-miki.digipack.io/demo-pay',
            'PaymentType' => 'aio',
            'ReturnURL' => 'https://demo-miki.digipack.io/demo-pay',
            'TotalAmount' => 2000,
            'TradeDesc' => '美琪蘭園',
            'CheckMacValue' => '',
        ];
        // 後方預設值為測試API用的參數
        $HashKey = env('ECPAY_HASH_KEY', 'pwFHCqoQZGmho4w6');
        $HashIV = env('ECPAY_HASH_IV', 'EkRm7iFT261dpevs');

        // 檢查碼字串11
        $checkMacValue = "ChoosePayment={$data->ChoosePayment}&ClientBackURL={$data->ClientBackURL}&EncryptType={$data->EncryptType}&IgnorePayment={$data->IgnorePayment}&ItemName={$data->ItemName}&MerchantID={$data->MerchantID}&MerchantTradeDate={$data->MerchantTradeDate}&MerchantTradeNo={$data->MerchantTradeNo}&PaymentInfoURL={$data->PaymentInfoURL}&PaymentType={$data->PaymentType}&ReturnURL={$data->ReturnURL}&TotalAmount={$data->TotalAmount}&TradeDesc={$data->TradeDesc}";

        $urlencode = urlencode('HashKey=' . $HashKey . '&' . $checkMacValue . '&HashIV=' . $HashIV);
        $strtolower = strtolower($urlencode);
        $hash = hash('sha256', $strtolower);
        $strtoupper = strtoupper($hash);

        $data->CheckMacValue = $strtoupper;
        return view('mytest', compact('data'));
    }

    public function back()
    {
        return view('return');
    }
    public function callBack(Request $request)
    {
        Log::create([
            'mylog' => json_encode($request->all())
        ]);
        return view('return');
    }

    public function mail_test()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('monkey811028@gmail.com')->send(new TestMail($mailData));
           
        dd("Email is sent successfully.");
    }
}
